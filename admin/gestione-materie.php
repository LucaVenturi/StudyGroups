<?php

require_once("../includes/init.php");

$user = requireAdmin();

$title = 'Gestione Materie';
$courses = $dbHelper->getCourses();
$mainContent = __DIR__ . '/../includes/templates/contents/admin-manage-subjects-content.php';

// Gestione messaggi dalla sessione.
$successMessage = $_SESSION['admin_success'] ?? null;
$errorMessage = $_SESSION['admin_error'] ?? null;
unset($_SESSION['admin_success'], $_SESSION['admin_error']);

$templateParams = [
    'title' => 'Gestione Materie',
    'main_content' => $mainContent,
    'courses' => $courses,
    'success' => $successMessage,
    'error' => $errorMessage,
    'js' => array(
        '../assets/js/gestione-materie.js'
    )
];

require(__DIR__ . '/../includes/templates/components/base.php');

?>