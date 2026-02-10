<?php

require_once(__DIR__ . '/../includes/init.php');

$templateParams["title"] = "Registrazione";
$templateParams["mainContent"] = "registration-form.php";
if(isset($_SESSION["erroreRegistrazione"])) {
    $templateParams["erroreRegistrazione"] = $_SESSION["erroreRegistrazione"];
    unset($_SESSION["erroreRegistrazione"]);
}

require(__DIR__ . '/../includes/templates/base.php');

?>