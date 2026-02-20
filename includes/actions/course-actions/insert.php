<?php

// Inizializzazione
require_once(__DIR__ . "/_course_actions_bootstrap.php");

// Se non è stato passato il nome del corso manda risposta d'errore.
if (!isset($_POST["name"]) || empty($_POST["name"])) {
    http_response_code(400);
    exit;
}

// Provo ad inserire il nuovo corso.
$name = trim($_POST['name']);
$success = $dbHelper->insertCourse($name);

if ($success) {
    $_SESSION['admin_success'] = 'Corso aggiunto con successo.';
} else {
    $_SESSION['admin_error'] = 'Errore durante l\'aggiunta del corso.';
}

header('Location: /StudyGroups/admin/gestione-corsi.php');
exit;