<?php

require_once "Database.php";

$database = new Database();
$db = $database->connect();

if ($db) {
    echo "✅ Conexión a la base de datos exitosa";
}