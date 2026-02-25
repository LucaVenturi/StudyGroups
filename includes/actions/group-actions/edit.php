<?php

require_once(__DIR__ . '/_group_actions_bootstrap.php');

// Se l'utente non è il creatore del gruppo non ha i permessi per modificare i dati del gruppo. Risposta di errore.
if (!$isUserCreator) {
    http_response_code(403);
    exit;
}

$groupId = (int) requirePostParam("group_id");
$title = trim(requirePostParam("title"));
$description = trim(requirePostParam("description"));
$exam_date = requirePostParam("exam_date");
$maxParticipants = (int) requirePostParam("max_participants");
$courseId = (int) requirePostParam("course_id");
$subjectName = requirePostParam("subject");

$today = new DateTime('today');
$dt = DateTime::createFromFormat("Y-m-d", $exam_date);

// Validazione input:
if (
    $groupId <= 0 ||
    empty($title) ||
    empty($description) ||
    !DateTime::createFromFormat("Y-m-d", $exam_date) || $dt < $today ||
    $maxParticipants <= 0 ||
    $courseId <= 0 ||
    empty($subjectName)
) {
    http_response_code(400);
    exit;
}

// Aggiorna il gruppo.
$success = $dbHelper->editGroup(
    $groupId, 
    $title, 
    $description, 
    $exam_date, 
    $maxParticipants, 
    $courseId, 
    $subjectName
);

if ($success) {
    header("Location: /StudyGroups/public/dettagli-gruppo.php?id=" . $groupId);
    exit;
} else {
    http_response_code(500);
    exit;
}

?>