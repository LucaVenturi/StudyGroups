<?php

require_once(__DIR__ . '/../init.php');

if (!isUserLoggedIn()) {
    header("Location: /StudyGroups/public/login.php");
    exit;
}

$user = getLoggedUser();

if (!isset($_GET["group_id"]) || !isset($_GET["action"])) {
    http_response_code(400);
    exit;
}

$groupId = $_GET["group_id"];
$action = $_GET["action"];

$doesGroupExist = $dbHelper->doesGroupExist($groupId);
$isUserCreator = $dbHelper->isUserGroupCreator($user["id"], $groupId) ?? false;

switch ($action) {
    case 'delete':
        // azione per eliminare il gruppo.
        if (!$doesGroupExist) {
            http_response_code(404);
            exit;
        }
        if (!$isUserCreator) {
            http_response_code(403);
            exit;
        }
        $success = $dbHelper->deleteGroup($groupId);
        if (!$success) {
            http_response_code(500);
            exit;
        }
        header("Location: /StudyGroups/public/mieigruppi.php");
        exit;
    case 'edit':
        // azione per modificare il gruppo.
    case 'insert':
        // azione per inserire un nuovo gruppo.
    default:
        http_response_code(400);
        break;
}

//TODO: USARE POST
//TODO: USARE POST
//TODO: USARE POST
//TODO: USARE POST
//TODO: USARE POST
//TODO: USARE POST
//TODO: USARE POST
//TODO: USARE POST
//TODO: USARE POST
//TODO: USARE POST
//TODO: USARE POST
//TODO: USARE POST
//TODO: USARE POST


?>
