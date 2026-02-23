<?php

require_once(__DIR__ . '/../../init.php');

$user = requireAdmin();

requirePostMethod();

$name = requirePostParam('name');
$courseId = requirePostParam('course_id');

// Controllo se la materia esiste
if (!$dbHelper->doesSubjectExist($courseId, $name)) {
    $_SESSION['admin_error'] = 'La materia ' . $name . ' del corso con id ' . $courseId . ' non esiste.';
    header('Location: /StudyGroups/admin/gestione-materie.php?course_id=' . $courseId);
    exit;
}

// Provo ad eliminare la materia.
$success = $dbHelper->deleteSubject($courseId, $name);

if ($success) {
    $_SESSION['admin_success'] = 'Materia aggiunta con successo.';
} else {
    $_SESSION['admin_error'] = 'Errore durante l\'aggiunta della materia.';
}

header('Location: /StudyGroups/admin/gestione-materie.php?course_id=' . $courseId);
exit;