<?php
session_start();
require_once('includes/helpers.php');
deleteSession('userdata');
header('Location: index.php');