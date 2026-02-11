<?php

// Richiede il file di inizializzazione che include anche il database helper.
require_once(__DIR__ . '/../init.php');

// Se già loggato, redirect alla home.
if (isUserLoggedIn()) {
    header("Location: /StudyGroups/public/index.php");
    exit;
}

// Se sono stati inviati email e password tramite POST, tentiamo il login.
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $user = $dbHelper->checkLogin($_POST["email"], $_POST["password"]);
    if ($user) {
        //Login riuscito, salviamo i dati dell'utente in sessione e redirigiamo alla home.
        rememberLoggedUser($user);
        header("Location: /StudyGroups/public/index.php");
        exit;
    } else {
        //Login fallito
        $_SESSION["login_error"] = "Errore! Controllare email o password!";
        header("Location: /StudyGroups/public/login.php");
        exit;
    }
}
    
// Se arriva qui in qualche modo, redirect a login
header("Location: /StudyGroups/public/login.php");
exit;

?>