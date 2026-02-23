<?php

require_once(__DIR__ . '/../../init.php');

$user = requireAdmin();

requirePostMethod();

$name =  requirePostParam('name');
$courseId = (int) requirePostParam('course_id');

// Validazione parametri.
if (empty($name)) {
    http_response_code(400);
    exit;
}
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