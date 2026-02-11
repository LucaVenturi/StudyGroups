<?php

require_once(__DIR__ . '/../includes/init.php');

$templateParams = array(
    "title" => "I miei gruppi",
    "main_content" => "my-groups-content.php",
    "groups" => $dbHelper->getGroups()
);

require(__DIR__ . '/../includes/templates/base.php');

?>