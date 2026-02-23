<?php

require_once(__DIR__ . '/../../init.php');

requireAdmin();

requirePostMethod();

$name = trim(requirePostParam('name'));

// Validazione parametri.
if (empty($_POST["name"])) {
    http_response_code(400);
    exit;
}

// Provo ad inserire il nuovo corso.
$success = $dbHelper->insertCourse($name);

if ($success) {
    $_SESSION['admin_success'] = 'Corso aggiunto con successo.';
} else {
    $_SESSION['admin_error'] = 'Errore durante l\'aggiunta del corso.';
}

header('Location: /StudyGroups/admin/gestione-corsi.php');
exit;