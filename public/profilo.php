<?php
require_once __DIR__ . '/../includes/init.php';

$user = requireLogin();

$isEditMode = isset($_GET["edit"]) && $_GET["edit"] == 1;

$templateParams = [
    'title'         => 'Il mio profilo',
    'main_content'  => __DIR__ . '/../includes/templates/forms/profile-form.php',
    'user'          => $user,
    'isEditMode'    => $isEditMode,
    'courses'       => $dbHelper->getCourses(),
    'count_created' => $dbHelper->getCreatedGroupsCount($user["id"]),
    'count_joined'  => $dbHelper->getJoinedGroupsCount($user["id"])
];

// Se nella sessione è stato salvato un errore, viene passato anche quello.
if (isset($_SESSION["profile_update_error"])) {
    $templateParams["profile_update_error"] = $_SESSION["profile_update_error"];
    unset($_SESSION["profile_update_error"]);
}


require(__DIR__ . '/../includes/templates/components/base.php');
