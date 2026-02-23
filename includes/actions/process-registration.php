<?php

// Richiede il file di inizializzazione che include anche il database helper.
require_once(__DIR__ . '/../init.php');

// Se già loggato, redirect alla home.
if (isUserLoggedIn()) {
    header("Location: /StudyGroups/public/index.php");
    exit;
}

requirePostMethod();

$email = filter_var(requirePostParam("email"), FILTER_VALIDATE_EMAIL);
$password = requirePostParam("password");
$confirm_password = requirePostParam("confirm_password");
$name = trim(requirePostParam("name"));
$surname = trim(requirePostParam("surname"));

// Validazione input.
if (empty($email) || empty($password) || empty($confirm_password) || empty($name) || empty($surname)) {
    $_SESSION['registration_error'] = "Per favore, compila tutti i campi obbligatori.";
    header("Location: /StudyGroups/public/register.php");
    exit;
}

// Controlla che le password coincidano.
if ($password !== $confirm_password) {
    $_SESSION['registration_error'] = "Le password non coincidono.";
    header("Location: /StudyGroups/public/register.php");
    exit;
}

// Parametri opzionali.
$course = !empty($_POST["course"]) 
    ? trim($_POST["course"]) 
    : null;
$telegram = !empty($_POST["telegram"]) 
    ? trim($_POST["telegram"]) 
    : null;

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
