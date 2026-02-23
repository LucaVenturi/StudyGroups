<?php

/**
 * Funzione per verificare se l'utente è loggato
 */
function isUserLoggedIn() {
    return isset($_SESSION['logged_user']);
}

/**
 * Funzione per ricordare l'utente loggato
 */
function rememberLoggedUser($user) {
    $_SESSION['logged_user'] = $user;
}

/**
 * Funzione per ottenere i dati dell'utente loggato
 */
function getLoggedUser() {
    return $_SESSION['logged_user'] ?? null;
}

/**
 * Funzione per disconnettere l'utente, presa dal manuale php.
 */
function logoutUser() {
    // Rimuove tutte le variabili di sessione
    session_unset();
    
    // Elimina anche il cookie di sessione
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(), 
            '', 
            time() - 42000,
            $params["path"], 
            $params["domain"],
            $params["secure"], 
            $params["httponly"]
        );
    }
    
    // Distrugge la sessione
    session_destroy();
}

/**
 * Memorizza l'immagine.
 */
function uploadImage($path, $image) {
    $imageName = basename($image["name"]);
    $fullPath = $path.$imageName;
    
    $maxKB = 500;
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif"); // TODO: sarebbe meglio controllare il mime con pathinfo.
    $result = 0;
    $msg = "";

    //Controllo se immagine è veramente un'immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    
    //Controllo dimensione dell'immagine < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }

    //Controllo estensione del file
    $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
    if(!in_array($imageFileType, $acceptedExtensions)){
        $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
    }

    //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
    if (file_exists($fullPath)) {
        $i = 1;
        do{
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
        }
        while(file_exists($path.$imageName));
        $fullPath = $path.$imageName;
    }

    //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
    if(strlen($msg)==0){
        if(!move_uploaded_file($image["tmp_name"], $fullPath)){
            $msg.= "Errore nel caricamento dell'immagine.";
        }
        else{
            $result = 1;
            $msg = $imageName;
        }
    }
    return array($result, $msg);
}

/**
 * Funzione che restituisce l'utente loggato solo se è loggato, altrimenti reindirizza alla pagina di login.
 */
function requireLogin(string $redirectTo = "/StudyGroups/public/login.php"): array {
    if (!isUserLoggedIn()) {
        header("Location: $redirectTo");
        exit;
    }
    return getLoggedUser();
}

/**
 * Funzione che restituisce l'utente loggato solo se è loggato e se è un admin.
 * Se non è loggato reindirizza al login e se non è admin manda risposta d'errore.
 */
function requireAdmin(string $redirectTo = "/StudyGroups/public/login.php"): array {
    $user = requireLogin($redirectTo);
    if (!($user["is_admin"] ?? false)) {
        http_response_code(403);
        exit;
    }
    return $user;
}

/**
 * Manda risposta d'errore se non è una richiesta POST.
 */
function requirePostMethod(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }
}

/**
 * Verifica se è stato passato in POST il parametro col nome specificato
 */
function requirePostParam(string $param): mixed {
    if (!isset($_POST[$param])) {
        http_response_code(400);
        exit;
    }
    return $_POST[$param];
}

/**
 * Verifica se è stato passato in GET il parametro col nome specificato.
 */
function requireGetParam(string $param): mixed {
    if (!isset($_GET[$param])) {
        http_response_code(400);
        exit;
    }
    return $_GET[$param];
}
