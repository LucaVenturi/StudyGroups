<?php
require_once __DIR__ . '/../includes/init.php';

// Verifica l'utente sia loggato.
if (!isUserLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user = getLoggedUser();
$isEditMode = isset($_GET["edit"]) && $_GET["edit"] == 1;

$templateParams = [
    'title'        => 'Il mio profilo',
    'main_content' => 'profile-content.php',
    'user'         => $user,
    'isEditMode'   => $isEditMode,
    'courses'      => $dbHelper->getCourses(),
    'count_created'      => $dbHelper->getCreatedGroupsCount($user["id"]),
    'count_joined' => $dbHelper->getJoinedGroupsCount($user["id"])
];

if (isset($_SESSION["profile_update_error"])) {
    $templateParams["profile_update_error"] = $_SESSION["profile_update_error"];
    unset($_SESSION["profile_update_error"]);
}


require __DIR__ . '/../includes/templates/base.php';
