<?php

require_once(__DIR__ . '/../includes/init.php');

// Paginazione
$itemsPerPage = 5;
$currentPage = isset($_GET['page']) && is_numeric($_GET['page'])
    ? max(1, (int)$_GET['page'])
    : 1;
$offset = ($currentPage - 1) * $itemsPerPage;
$window = 2;

// Leggi filtri, se non sono settati verranno tutti impostati a null e ignorati dalla funzione getGroupsFiltered
$courseId = isset($_GET['course_id']) && !empty($_GET['course_id'])
    ? (int)$_GET['course_id']
    : null;

$subject  = isset($_GET['subject']) && !empty($_GET['subject'])
    ? $_GET['subject']
    : null;

$date = isset($_GET['date']) && !empty($_GET['date'])
    ? $_GET['date']
    : null;

$showFull = isset($_GET['show_full'])
    ? true
    : false;

$totalGroups = $dbHelper->countGroupsFiltered(
    $courseId,
    $subject,
    $date,
    $showFull
);

$totalPages = ceil($totalGroups / $itemsPerPage);

$templateParams = array(
    "title" => "Trova gruppi",
    "main_content" => "../includes/templates/contents/find-groups-content.php",
    "groups" => $dbHelper->getGroupsFilteredPaginated(
        $courseId,
        $subject,
        $date,
        $showFull,
        $itemsPerPage,
        $offset
    ),
    "courses" => $dbHelper->getCourses(),
    "currentPage" => $currentPage,
    "totalPages" => $totalPages,
    "window" => $window,
    "js" => array(
        '../assets/js/utils.js',
        '../assets/js/trova-gruppi.js'
    )
);

require(__DIR__ . '/../includes/templates/components/base.php');
