<?php

require_once(__DIR__ . '/../includes/init.php');

if (!isset($_GET['id'])) {
    header("Location: annunci.php");
    exit();
}

$groupId = (int) $_GET['id'];

$templateParams = array(
    "title" => "Dettagli Gruppo",
    "main_content" => __DIR__ . "/../includes/templates/contents/group-details-content.php",
    "group" => $dbHelper->getGroupById($groupId),
    "creator" => $dbHelper->getGroupCreator($groupId),
    "partecipants" => $dbHelper->getGroupPartecipants($groupId),
);

require(__DIR__ . '/../includes/templates/components/base.php');

?>