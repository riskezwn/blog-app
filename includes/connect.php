<?php

// Conexión a base de datos
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'blog';

$con = mysqli_connect($server, $user, $pass, $db);
mysqli_query($con, "SET names 'utf8'");

if (mysqli_connect_errno()) {
    echo 'Error en la conexión en la base de datos: ' . mysqli_connect_error();
    die();
} 

if (!isset($_SESSION)) {
    session_start();
}