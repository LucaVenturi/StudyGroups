<?php

// Richiede il file di inizializzazione che include anche il database helper.
require_once(__DIR__ . '/../init.php');

// Se non è  loggato, redirect al login.
if (!isUserLoggedIn()) {
    header("Location: /StudyGroups/public/login.php");
    exit;
}

// Memorizzo l'utente.
$user = getLoggedUser();

// Se non sono stati passati group_id o action, risposta di errore.
if (!isset($_GET["group_id"]) || !isset($_GET["action"])) {
    $destination = "/StudyGroups/public/";
    $destination .= isset($_GET["group_id"])
        ? "dettagli-gruppo.php?id=" . $_GET["group_id"]
        : "annunci.php";
    header("Location: " . $destination);
    exit;
}

// Parametri passati in get.
$groupId = $_GET["group_id"];
$action = $_GET["action"];

// Verifica che il gruppo esista, altrimenti errore 404.
if (!$dbHelper->doesGroupExist($groupId)) {
    http_response_code(404);
    exit;
}

$isUserCreator = $dbHelper->isUserGroupCreator($user["id"], $groupId);
if ($isUserCreator) {
    // Reindirizza da qualche parte, il creatore non può entrare o uscire.
    // Al massimo può eliminare il gruppo.
}

$isUserParticipant = $dbHelper->isUserGroupParticipant($user["id"], $groupId);

// Aggiungi o rimuovi l'utente dal gruppo a seconda dell'azione
switch ($action) {
    case 'join':
        if (!$isUserParticipant) {
            $success = $dbHelper->joinGroup($user["id"], $groupId);
            if ($success) {
                header("Location: ../../public/dettagli-gruppo.php?id=" . $groupId);
            } else {
                http_response_code(500);
            }
        } else {
            http_response_code(403);
        }
        exit;
    case 'leave':
        if ($isUserParticipant) {
            $success = $dbHelper->leaveGroup($user["id"], $groupId);
            if ($success) {
                header("Location: ../../public/dettagli-gruppo.php?id=" . $groupId);
            } else {
                http_response_code(500);
            }
        } else {
            http_response_code(403);
        }
        exit;
    default:
        http_response_code(400);
        break;
}
