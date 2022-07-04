<?php

// Conexión a base de datos
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);

$active_group = 'default';
$query_builder = TRUE;

$con = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

mysqli_query($con, "SET names 'utf8'");

if (mysqli_connect_errno()) {
    echo 'Error en la conexión en la base de datos: ' . mysqli_connect_error();
    die();
} 

if (!isset($_SESSION)) {
    session_start();
}