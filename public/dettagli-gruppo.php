<?php

require_once(__DIR__ . '/../includes/init.php');

$groupId = (int) requireGetParam('id');

if (!$dbHelper->doesGroupExist($groupId)) {
    http_response_code(404);
    exit;
}

$templateParams = array(
    "title" => "Dettagli Gruppo",
    "main_content" => __DIR__ . "/../includes/templates/contents/group-details-content.php",
    "group" => $dbHelper->getGroupById($groupId),
    "creator" => $dbHelper->getGroupCreator($groupId),
    "partecipants" => $dbHelper->getGroupParticipants($groupId),
);

require(__DIR__ . '/../includes/templates/components/base.php');

?>