<?php

require_once(__DIR__ . '/../../init.php');

requirePostMethod();

$user = requireLogin();

$title = trim(requirePostParam("title"));
$description = trim(requirePostParam("description"));
$examDate = requirePostParam("exam_date");
$maxParticipants = (int) requirePostParam("max_participants");
$courseId = (int) requirePostParam("course_id");
$subjectName = requirePostParam("subject");

// Validazione input.
if (
    empty($title) ||
    empty($description) ||
    !DateTime::createFromFormat("Y-m-d", $examDate) ||
    $maxParticipants <= 0 ||
    $courseId <= 0 ||
    empty($subjectName)
) {
    http_response_code(400);
    exit;
}

// Prova ad inserire il gruppo nel database.
$success = $dbHelper->insertGroup(
    $title,
    $description,
    $examDate,
    $maxParticipants,
    $courseId,
    $subjectName,
    $user["id"]
);

if ($success) {
    header("Location: /StudyGroups/public/miei-gruppi.php");
    exit;
} else {
    http_response_code(500);
    exit;
}

?>