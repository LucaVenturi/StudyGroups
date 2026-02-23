<?php

require_once(__DIR__ . '/../includes/init.php');

$user = requireLogin();

$tab = $_GET["tab"] ?? "joined";
$tab = in_array($tab, array("joined", "created")) ? $tab : "joined";

$templateParams = array(
    "title" => "I miei gruppi",
    "main_content" => __DIR__ . "/../includes/templates/contents/my-groups-content.php",
    "groups_partecipting_in" => $dbHelper->getGroupsWithParticipant($user['id']),
    "groups_created" => $dbHelper->getGroupsCreatedBy($user['id']),
    "tab" => $tab
);

require(__DIR__ . '/../includes/templates/components/base.php');

?>