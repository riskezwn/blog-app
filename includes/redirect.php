<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['userdata'])) {
    header('Location: index.php');
}