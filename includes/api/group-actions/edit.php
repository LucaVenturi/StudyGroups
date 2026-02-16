<?php

require_once(__DIR__ . '/_group_actions_bootstrap.php');

// Se l'utente non è il creatore del gruppo non ha i permessi per modificare i dati del gruppo. Risposta di errore.
if (!$isUserCreator) {
    http_response_code(403);
    exit;
}

// Se non sono stati passati tutti i parametri necessari manda risposta di errore.
if (
    !isset($_POST["group_id"]) ||
    !isset($_POST["title"]) ||
    !isset($_POST["description"]) ||
    !isset($_POST["exam_date"]) ||
    !isset($_POST["max_participants"]) ||
    !isset($_POST["course_id"]) ||
    !isset($_POST["subject"])
) {
    http_response_code(400);
    exit;
}

// Aggiorna il gruppo.
$success = $dbHelper->editGroup(
    $_POST["group_id"], 
    $_POST["title"], 
    $_POST["description"], 
    $_POST["exam_date"], 
    $_POST["max_participants"], 
    $_POST["course_id"], 
    $_POST["subject"], 
    $groupId
);

if ($success) {
    header("Location: /StudyGroups/public/dettagli-gruppo.php?id=" . $groupId);
    exit;
} else {
    http_response_code(500);
    exit;
}

?>