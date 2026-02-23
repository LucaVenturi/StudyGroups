<?php

require_once(__DIR__ . '/../../init.php');

requirePostMethod();

$user = requireAdmin();
$courseId = (int) requirePostParam('course_id');

// Validazione parametri.
if ($courseId <= 0) {
    http_response_code(400);
    exit;
}

// Verifica che il corso esista.
if (!$dbHelper->doesCourseExist($courseId)) {
    $_SESSION['admin_error'] = 'Corso con ID ' . $courseId . ' non trovato.';
    header('Location: /StudyGroups/admin/gestione-corsi.php');
    exit;
}

// Provo a cancellare il corso.
$success = $dbHelper->deleteCourse($courseId);

if ($success)
    $_SESSION['admin_success'] = 'Corso eliminato con successo.';
else
    $_SESSION['admin_error'] = 'Errore durante l\'eliminazione del corso.';

header('Location: /StudyGroups/admin/gestione-corsi.php');
exit;