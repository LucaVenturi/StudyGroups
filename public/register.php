<?php

require_once(__DIR__ . '/../includes/init.php');

if(isUserLoggedIn()) {
    header("Location: index.php");
    exit();
}

$templateParams["title"] = "Registrazione";
$templateParams["main_content"] = __DIR__ . "/../includes/templates/forms/registration-form.php";
$templateParams["courses"] = $dbHelper->getCourses();

if(isset($_SESSION["registration_error"])) {
    $templateParams["registration_error"] = $_SESSION["registration_error"];
    unset($_SESSION["registration_error"]);
}

require(__DIR__ . '/../includes/templates/components/base.php');

?>