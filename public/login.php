<?php

require_once(__DIR__ . '/../includes/init.php');

$templateParams["title"] = "Login";
$templateParams["mainContent"] = "login-form.php";
if(isset($_SESSION["erroreLogin"])) {
    $templateParams["errorelogin"] = $_SESSION["erroreLogin"];
    unset($_SESSION["erroreLogin"]);
}

require(__DIR__ . '/../includes/templates/base.php');

?>