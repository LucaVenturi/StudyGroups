<?php

require_once(__DIR__ . '/_group_actions_bootstrap.php');

// Se l'utente non è il creatore del gruppo non ha i permessi per cancellare il gruppo. Risposta di errore.
if (!$isUserCreator) {
    http_response_code(403);
    exit;
}

// Cancella il gruppo.
$success = $dbHelper->deleteGroup($groupId);

if ($success) {
    header("Location: /StudyGroups/public/miei-gruppi.php");
    exit;
} else {
    http_response_code(500);
    exit;
}

?>