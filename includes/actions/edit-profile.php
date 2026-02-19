<?php

require_once(__DIR__ . '/../init.php');

if (!isUserLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user = getLoggedUser();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit;
}

if (
    !isset($_POST["name"]) ||
    !isset($_POST["surname"]) ||
    !isset($_POST["email"])
) {
    http_response_code(400);
    exit;
}

$userId = $user["id"];
$nome = trim($_POST["name"]);
$cognome = trim($_POST["surname"]);
$email = trim($_POST["email"]);
$telegram = empty($_POST["telegram"]) ? null : trim($_POST["telegram"]);
$corso = empty($_POST["course"]) ? null : trim($_POST["course"]);


$fotoProfilo = $user["foto_profilo"]; // default: mantieni quella attuale

if (isset($_FILES["foto_profilo"]) && strlen($_FILES["foto_profilo"]["name"]) > 0) {
    [$result, $msg] = uploadImage(UPLOAD_DIR, $_FILES["foto_profilo"]);
    if (!$result) {
        $_SESSION["profile_update_error"] = $msg;
        header("Location: /StudyGroups/public/profilo.php?edit=1");
        exit;
    }
    $fotoProfilo = $msg;
}


$success = $dbHelper->updateUser($userId, $nome, $cognome, $email, $fotoProfilo, $telegram, $corso);

if ($success) {
    // Aggiorna i dati dell'utente in sessione
    $user["nome"] = $nome;
    $user["cognome"] = $cognome;
    $user["email"] = $email;
    $user["foto_profilo"] = $fotoProfilo;
    $user["telegram"] = $telegram;
    $user["id_cdl"] = $corso;
    
    rememberLoggedUser($user);

    header('Location: /StudyGroups/public/profilo.php');
    exit;
} else {
    $_SESSION["profile_update_error"] = "Errore durante l'aggiornamento dei dati sul server, riprova tra poco.";
    header('Location: /StudyGroups/public/profilo.php?edit=1');
    exit;
}

?>