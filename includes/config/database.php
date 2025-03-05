<?php

require_once __DIR__ . '/config.php';

function conectarDB() : mysqli {
    global $DB_host, $DB_user, $DB_password, $DB_database;

    $db = new mysqli($DB_host, $DB_user, $DB_password, $DB_database);

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}