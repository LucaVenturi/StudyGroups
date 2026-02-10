<?php

function isUserLoggedIn(){
    return !empty($_SESSION['idUtente']);
}

function rememberLoggedUser($user) {
    $_SESSION['idUtente'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['nome'] = $user['nome'];
    $_SESSION['cognome'] = $user['cognome'];
    $_SESSION['foto_profilo'] = $user['foto_profilo'];
    $_SESSION['isAdmin'] = $user['isAdmin'];
}

?>