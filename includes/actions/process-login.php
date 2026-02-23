<?php

// Richiede il file di inizializzazione che include anche il database helper.
require_once(__DIR__ . '/../init.php');

// Se già loggato, redirect alla home.
if (isUserLoggedIn()) {
    header("Location: /StudyGroups/public/index.php");
    exit;
}

$email = filter_var(requirePostParam("email"), FILTER_VALIDATE_EMAIL);
$password = requirePostParam("password");

// Validazione input.
if (empty($email) || empty($password)) {
    http_response_code(400);
    exit;
}

// Tentiamo il login.
$user = $dbHelper->checkLogin($email, $password);
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
    
// Se arriva qui in qualche modo, redirect a login
header("Location: /StudyGroups/public/login.php");
exit;

?>