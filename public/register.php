<?php

require_once(__DIR__ . '/../includes/init.php');

// Se l'utente è già loggato lo reindirizza alla home.
if(isUserLoggedIn()) {
    header("Location: index.php");
    exit();
}

$templateParams["title"] = "Registrazione";
$templateParams["main_content"] = __DIR__ . "/../includes/templates/forms/registration-form.php";
$templateParams["courses"] = $dbHelper->getCourses();

// Se nella sessione è salvato un messaggio di errore viene passato alla pagina e viene fatto l'unset.
if(isset($_SESSION["registration_error"])) {
    $templateParams["registration_error"] = $_SESSION["registration_error"];
    unset($_SESSION["registration_error"]);
}

require(__DIR__ . '/../includes/templates/components/base.php');

?>