<?php


/**
 * Funzione per verificare se l'utente è loggato
 */
function isUserLoggedIn()
{
    return !empty($_SESSION['id_utente']);
}

/**
 * Funzione per ricordare l'utente loggato
 */
function rememberLoggedUser($user)
{
    $_SESSION['id_utente'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['nome'] = $user['nome'];
    $_SESSION['cognome'] = $user['cognome'];
    $_SESSION['foto_profilo'] = $user['foto_profilo'];
    $_SESSION['is_admin'] = $user['is_admin'];
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
