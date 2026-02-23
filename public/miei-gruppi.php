<?php

require_once(__DIR__ . '/../includes/init.php');

$user = requireLogin();

$templateParams = array(
    "title" => "I miei gruppi",
    "main_content" => __DIR__ . "/../includes/templates/contents/my-groups-content.php",
    "groups_partecipting_in" => $dbHelper->getGroupsWithParticipant($user['id']),
    "groups_created" => $dbHelper->getGroupsCreatedBy($user['id'])
);

require(__DIR__ . '/../includes/templates/components/base.php');

?>