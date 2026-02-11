<?php

require_once(__DIR__ . '/../includes/init.php');

if(isUserLoggedIn()) {
    header("Location: index.php");
    exit();
}

$templateParams["title"] = "Login";
$templateParams["main_content"] = "login-form.php";
if(isset($_SESSION["login_error"])) {
    $templateParams["login_error"] = $_SESSION["login_error"];
    unset($_SESSION["login_error"]);
}

require(__DIR__ . '/../includes/templates/base.php');

?>