<?php

function conectarDB():mysqli{
    $db = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_NAME']
    );

    $db->set_charset('utf8');

    if (!$db){
        echo "Error: No se pudo conectar a MySQL";
        exit;
    }
    return $db;
}