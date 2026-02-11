<?php


/**
 * Funzione per verificare se l'utente è loggato
 */
function isUserLoggedIn()
{
    return isset($_SESSION['logged_user']);
}

/**
 * Funzione per ricordare l'utente loggato
 */
function rememberLoggedUser($user) {
    $_SESSION['logged_user'] = $user;
}

/**
 * Funzione per ottenere i dati dell'utente loggato
 */
function getLoggedUser() {
    return $_SESSION['logged_user'] ?? null;
}

/**
 * Funzione per disconnettere l'utente, presa dal manuale php.
 */
function logoutUser() {
    // Rimuove tutte le variabili di sessione
    session_unset();
    
    // Elimina anche il cookie di sessione
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(), 
            '', 
            time() - 42000,
            $params["path"], 
            $params["domain"],
            $params["secure"], 
            $params["httponly"]
        );
    }
    
    // Distrugge la sessione
    session_destroy();
}
