<?php

require_once(__DIR__ . '/../includes/init.php');

// Recupera l'utente loggato.
$user = requireLogin();

// Memorizzo l'azione richiesta.
$action = requireGetParam('action');

switch ($action) {
    case 'edit':
        // Setto il titolo della pagina.
        $title = "Modifica gruppo";

        // Memorizza l'id del gruppo.
        $groupId = (int) requireGetParam('group_id');

        // Verifica se il gruppo esiste.
        if (!$dbHelper->doesGroupExist($groupId)) {
            http_response_code(404);
            exit;
        }

        // Verifica se l'utente è il creatore del gruppo.
        if (!$dbHelper->isUserGroupCreator($user["id"], $groupId)) {
            http_response_code(403);
            exit;
        }

        // Recupera i dati del gruppo.
        $group = $dbHelper->getGroupById($groupId);
        break;
    case 'insert':
        // Setto il titolo della pagina.
        $title = "Crea gruppo";

        // Creo un gruppo vuoto.
        $group = array(
            "titolo" => "", 
            "descrizione" => "", 
            "data_esame" => "", 
            "max_partecipanti" => "", 
            "id_cdl" => "", 
            "corso_di_laurea" => "", 
            "materia" => ""
        );
        break;
    default:
        http_response_code(400);
        exit;
}

// Setto i parametri richiesti dalla pagina.
$templateParams = array(
    "title" => $title,
    "main_content" => __DIR__ . "/../includes/templates/forms/group-form.php",
    "action" => $action,
    "courses" => $dbHelper->getCourses(),
    "group" => $group,
    "js" => array(
        '../assets/js/utils.js',
        '../assets/js/trova-gruppi.js'
    )
);

require(__DIR__ . '/../includes/templates/components/base.php');
