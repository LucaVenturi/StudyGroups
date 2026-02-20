<?php
require_once(__DIR__ . '/../../init.php');

// Se la richiesta non è POST, risposta di errore.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

// Se l'utente non è loggato reindirizza al login.
if (!isUserLoggedIn()) {
    header("Location: /StudyGroups/public/login.php");
    exit;
}

// Memorizzo l'utente.
$user = getLoggedUser();

// Se l'utente non è admin manda risposta d'errore.
if (!$user["is_admin"]) {
    http_response_code(403);
    exit;
}

// // Se non è stato inviato un id di un gruppo manda risposta d'errore.
// if (!isset($_POST["group_id"])) {
//     http_response_code(400);
//     exit;
// }

// // Memorizzo l'id del gruppo oggetto della richiesta.
// $groupId = (int) $_POST["group_id"];

// // Se il gruppo non esiste manda risposta d'errore.
// if (!$dbHelper->doesGroupExist($groupId)) {
//     http_response_code(404);
//     exit;
// }

// // Memorizzo se l'utente è un partecipante e se è il creatore.
// $isUserCreator = $dbHelper->isUserGroupCreator($user["id"], $groupId);
// $isUserParticipant = $dbHelper->isUserGroupParticipant($user["id"], $groupId);
