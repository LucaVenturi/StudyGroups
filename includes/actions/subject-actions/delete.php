<?php

// Inizializzazione
require_once(__DIR__ . "/_subject_actions_bootstrap.php");

// Se non sono stati passati il nome della materia
// e l'id del corso a cui appartiene 
// manda una risposta d'errore.
if (
    !isset($_POST["name"]) || 
    !isset($_POST["course_id"]
)
) {
    var_dump($_POST);
    exit;
    //http_response_code(400);
    //exit;
}

// Memorizzo i parametri.
$name = trim($_POST['name']);
$courseId = (int) $_POST['course_id'];

// Controllo se la materia esiste
if (!$dbHelper->doesSubjectExist($courseId, $name)) {
    $_SESSION['admin_error'] = 'La materia non esiste.';
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