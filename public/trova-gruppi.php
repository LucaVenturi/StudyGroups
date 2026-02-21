<?php

require_once(__DIR__ . '/../includes/init.php');

// Leggi filtri
$courseId = isset($_GET['course_id']) && !empty($_GET['course_id']) ? (int)$_GET['course_id'] : null;
$subject  = isset($_GET['subject']) && !empty($_GET['subject']) ? $_GET['subject'] : null;
$date     = isset($_GET['date']) && !empty($_GET['date']) ? $_GET['date'] : null;
$showFull = isset($_GET['show_full']) ? true : false;


$templateParams = array(
    "title" => "Trova gruppi",
    "main_content" => "../includes/templates/contents/find-groups-content.php",
    "groups" => $dbHelper->getGroupsFiltered(
        $courseId,
        $subject,
        $date,
        $showFull
    ),
    "courses" => $dbHelper->getCourses(),
    "js" => array(
        '../assets/js/utils.js',
        '../assets/js/trova-gruppi.js'
    )
);

require(__DIR__ . '/../includes/templates/components/base.php');
