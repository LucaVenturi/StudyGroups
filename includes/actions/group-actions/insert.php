<?php

require_once(__DIR__ . '/../../init.php');

requirePostMethod();

$user = requireLogin();

$title = requirePostParam("title");
$description = requirePostParam("description");
$examDate = requirePostParam("exam_date");
$maxParticipants = requirePostParam("max_participants");
$courseId = (int) requirePostParam("course_id");
$subjectName = requirePostParam("subject");

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