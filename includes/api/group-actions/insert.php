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

// Se non sono stati passati tutti i dati necessari manda risposta d'errore.
if (
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

// Prova ad inserire il gruppo nel database.
$success = $dbHelper->insertGroup(
    $_POST["title"],
    $_POST["description"],
    $_POST["exam_date"],
    $_POST["max_participants"],
    $_POST["course_id"],
    $_POST["subject"],
    $user["id"]
);

if ($success) {
    header("Location: /StudyGroups/public/mieigruppi.php");
    exit;
} else {
    http_response_code(500);
    exit;
}

?>