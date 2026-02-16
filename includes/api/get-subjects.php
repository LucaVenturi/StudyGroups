<?php

require_once(__DIR__ . '/../init.php');

// Imposta l'header per JSON
header('Content-Type: application/json');

// Verifica che sia stata passata l'ID del corso
if (!isset($_GET['course_id']) || empty($_GET['course_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID corso non fornito']);
    exit;
}

$courseId = $_GET['course_id'];

try {
    // Recupera le materie dal database
    $subjects = $dbHelper->getSubjectsByCourse($courseId);
    
    // Restituisce le materie in formato JSON
    echo json_encode($subjects);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Errore nel recupero delle materie']);
}