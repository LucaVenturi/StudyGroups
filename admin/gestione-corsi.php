<?php

require_once("../includes/init.php");

// L'utente deve essere loggato.
if (!isUserLoggedIn()) {
    header("Location: ../public/login.php");
    exit();
}

$user = getLoggedUser();

// L'utente deve essere admin.
if (!isset($user["is_admin"]) || !$user["is_admin"]) {
    http_response_code(401);
    exit();
}

$courses = $dbHelper->getCourses();

// Gestione messaggi flash
$success_message = $_SESSION['admin_success'] ?? null;
$error_message = $_SESSION['admin_error'] ?? null;
unset($_SESSION['admin_success'], $_SESSION['admin_error']);

$templateParams = [
    'title' => 'Gestione Corsi di Laurea',
    'main_content' => __DIR__ . '/../includes/templates/contents/admin-manage-courses-content.php',
    'courses' => $courses,
    'success' => $success_message,
    'error' => $error_message
];

require(__DIR__ . '/../includes/templates/components/base.php');

?>