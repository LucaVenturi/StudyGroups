<?php

// Richiede il file di inizializzazione che include anche il database helper.
require_once(__DIR__ . '/../init.php');

// Se già loggato, redirect alla home.
if (isUserLoggedIn()) {
    header("Location: /StudyGroups/public/index.php");
    exit;
}

// Se è una richiesta POST, tentiamo di processare la registrazione.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Se sono stati inviati tutti i campi obbligatori, tentiamo la registrazione.
    if (
        isset($_POST["email"])
        && isset($_POST["password"])
        && isset($_POST["confirm_password"])
        && isset($_POST["name"])
        && isset($_POST["surname"])
    ) {
        $email = trim($_POST["email"]);
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $name = trim($_POST["name"]);
        $surname = trim($_POST["surname"]);

        // Controlla che le password coincidano.
        if ($password !== $confirm_password) {
            $_SESSION['registration_error'] = "Le password non coincidono.";
            header("Location: /StudyGroups/public/register.php");
            exit;
        }

        $course = !empty($_POST["course"]) ? trim($_POST["course"]) : null;
        $telegram = !empty($_POST["telegram"]) ? trim($_POST["telegram"]) : null;

        // Tenta di registrare l'utente.
        $user = $dbHelper->registerUser($name, $surname, $email, $password, $course, $telegram);
        if ($user) {
            // Registrazione riuscita, login automatico
            rememberLoggedUser($user);
            header("Location: /StudyGroups/public/index.php");
            exit;
        } else {
            $_SESSION['registration_error'] = "Errore durante la registrazione";
            header("Location: /StudyGroups/public/register.php");
            exit;
        }
    } else {
        $_SESSION['registration_error'] = "Per favore, compila tutti i campi obbligatori.";
        header("Location: /StudyGroups/public/register.php");
        exit;
    }
}


// Se arriva qui in qualche modo, redirect a register.
header("Location: /StudyGroups/public/register.php");
exit;
