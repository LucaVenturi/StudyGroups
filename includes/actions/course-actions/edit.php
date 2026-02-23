<?php

require_once(__DIR__ . '/../../init.php');

$user = requireAdmin();

requirePostMethod();

$name =  trim(requirePostParam('name'));
$courseId = (int) requirePostParam('course_id');

// Valida i parametri
if ($name === '' || $courseId <= 0) {
    http_response_code(400);
    exit;
}

// Verifica che il corso esista.
if (!$dbHelper->doesCourseExist($courseId)) {
    $_SESSION['admin_error'] = 'Corso con ID ' . $courseId . ' non trovato.';
    header('Location: /StudyGroups/admin/gestione-corsi.php');
    exit;
}

// Provo ad aggiornare il corso.
$success = $dbHelper->editCourse($courseId, $name);

if ($success) {
    $_SESSION['admin_success'] = 'Corso modificato con successo.';
} else {
    $_SESSION['admin_error'] = 'Errore durante la modifica del corso.';
}

header('Location: /StudyGroups/admin/gestione-corsi.php');
exit;