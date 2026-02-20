<?php

// Inizializzazione
require_once(__DIR__ . "/_course_actions_bootstrap.php");

// Se non sono stati passati i parametri necessari manda risposta di errore.
if (
    !isset($_POST["name"]) ||
    !isset($_POST["course_id"])
) {
    http_response_code(400);
    exit;
}

// Memorizzo i parametri.
$name = trim($_POST['name']);
$courseId = (int) $_POST['course_id'];

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