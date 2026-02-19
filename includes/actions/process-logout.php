<?php

// Richiede il file di inizializzazione che include anche il database helper.
require_once(__DIR__ . '/../init.php');

// Se non è loggato, redirect alla home.
if (!isUserLoggedIn()) {
    header("Location: /StudyGroups/public/index.php");
    exit;
}

// Esegue il logout dell'utente e redirige alla home.
logoutUser();
header("Location: /StudyGroups/public/index.php");
exit;