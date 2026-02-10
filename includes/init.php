<?php

require_once './db/database.php';

$dbHelper = new DatabaseHelper(
    'localhost', // Servername
    'root',      // Username
    '',          // Password
    'webtech_studygroups', // Database name
    3306         // Port
);

?>