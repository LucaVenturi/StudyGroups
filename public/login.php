<?php

require_once(__DIR__ . '/../includes/init.php');

$templateParams = array(
    "title" => "Login",
    "mainContent" => "login-form.php",
    "errorelogin" => isset($_SESSION["errorelogin"]) ? $_SESSION["errorelogin"] : null
);

require(__DIR__ . '/../includes/templates/base.php');

?>