<?php

require_once(__DIR__ . '/../../init.php');

$user = requireAdmin();

requirePostMethod();

$name = requirePostParam('name');
$courseId = requirePostParam('course_id');

// Provo ad inserire il nuovo corso.
$success = $dbHelper->createSubject($courseId, $name);

if ($success) {
    $_SESSION['admin_success'] = 'Materia aggiunta con successo.';
} else {
    $_SESSION['admin_error'] = 'Errore durante l\'aggiunta della materia.';
}

header('Location: /StudyGroups/admin/gestione-materie.php?course_id=' . $courseId);
exit;