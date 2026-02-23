<?php

require_once(__DIR__ . '/../includes/init.php');

// Se l'utente è già loggato reindirizza alla home.
if(isUserLoggedIn()) {
    header("Location: index.php");
    exit();
}

$templateParams["title"] = "Login";
$templateParams["main_content"] = __DIR__ . "/../includes/templates/forms/login-form.php";

// Se nella sessione è stato salvato un messaggio di errore viene passato alla pagina.
if(isset($_SESSION["login_error"])) {
    $templateParams["login_error"] = $_SESSION["login_error"];
    unset($_SESSION["login_error"]);
}

require(__DIR__ . '/../includes/templates/components/base.php');

?>