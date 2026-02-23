<?php

require_once("../includes/init.php");

$user = requireAdmin();

$title = 'Gestione Corsi di Laurea';
$courses = $dbHelper->getCourses();
$mainContent = __DIR__ . '/../includes/templates/contents/admin-manage-courses-content.php';

// Gestione messaggi dalla sessione.
$successMessage = $_SESSION['admin_success'] ?? null;
$errorMessage = $_SESSION['admin_error'] ?? null;
unset($_SESSION['admin_success'], $_SESSION['admin_error']);

$templateParams = [
    'title' => $title,
    'main_content' => $mainContent,
    'courses' => $courses,
    'success' => $successMessage,
    'error' => $errorMessage
];

require(__DIR__ . '/../includes/templates/components/base.php');

?>