<?php

require_once(__DIR__ . '/../init.php');


$user = requireLogin();

requirePostMethod();

// Parametri obbligatori.
$nome = requirePostParam("name");
$cognome = requirePostParam("surname");
$email = requirePostParam("email");

// Parametri opzionali.
$telegram = empty($_POST["telegram"]) 
    ? null 
    : trim($_POST["telegram"]);

$corso = empty($_POST["course"]) 
    ? null 
    : trim($_POST["course"]);

$fotoProfilo = $user["foto_profilo"]; // default: mantieni quella attuale

// Se c'è una foto profilo valida tra i file, la memorizza in locale e sovrascrive $fotoProfilo.
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