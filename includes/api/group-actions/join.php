<?php

// File che verifica la richiesta sia corretta e memorizza i dati necessari.
require_once(__DIR__ . '/_group_actions_bootstrap.php');

// Se non è un partecipante e se non è il creatore, inserisce l'utente nel gruppo.
if (!$isUserParticipant && !$isUserCreator) {
    $success = $dbHelper->joinGroup($user["id"], $groupId);
    if ($success) {
        header("Location: /StudyGroups/public/dettagli-gruppo.php?id=" . $groupId);
        exit;
    } else {
        http_response_code(500);
        exit;
    }
} else {
    http_response_code(403);
    exit;
}

?>