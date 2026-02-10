<?php

require_once(__DIR__ . '/../includes/init.php');

$templateParams = array(
    "title" => "Annunci",
    "mainContent" => "find-groups.php",
    "groups" => $dbHelper->getGroups()
);

require(__DIR__ . '/../includes/templates/base.php');

?>