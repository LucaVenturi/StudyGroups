<?php

require_once(__DIR__ . '/../../init.php');

requirePostMethod();

$user = requireLogin();
$groupId = (int) requirePostParam("group_id");

if (!$dbHelper->doesGroupExist($groupId)) {
    http_response_code(404);
    exit;
}

$isUserCreator = $dbHelper->isUserGroupCreator($user["id"], $groupId);
$isUserParticipant = $dbHelper->isUserGroupParticipant($user["id"], $groupId);

?>