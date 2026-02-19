<?php

require_once(__DIR__ . '/../includes/init.php');

$templateParams = array(
    "title" => "Annunci",
    "main_content" => "../includes/templates/contents/find-groups-content.php",
    "groups" => $dbHelper->getGroups(),
);

require(__DIR__ . '/../includes/templates/components/base.php');

?>