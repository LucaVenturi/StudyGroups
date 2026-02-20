<?php

require_once("../includes/init.php");

// L'utente deve essere loggato.
if (!isUserLoggedIn()) {
    header("Location: ../public/login.php");
    exit();
}

$user = getLoggedUser();

// L'utente deve essere admin.
if (!isset($user["is_admin"]) || !$user["is_admin"]) {
    http_response_code(401);
    exit();
}

echo "tutto ok";


?>