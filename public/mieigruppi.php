<?php

require_once(__DIR__ . '/../includes/init.php');

if(!isUserLoggedIn()) {
    header("Location: login.php");
    exit();
}

$templateParams = array(
    "title" => "I miei gruppi",
    "main_content" => "my-groups-content.php",
    "groups_partecipting_in" => $dbHelper->getGroupsWithParticipant($_SESSION['logged_user']['id']),
    "groups_created" => $dbHelper->getGroupsCreatedBy($_SESSION['logged_user']['id'])
);

require(__DIR__ . '/../includes/templates/base.php');

?>