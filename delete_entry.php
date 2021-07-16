<?php
require_once 'includes/redirect.php';
require_once 'includes/connect.php';
require_once 'includes/helpers.php';

if (isset($_GET['id']) && sanitizeNum($con, $_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['userdata']['id'];

    if ($user_id != 10) {
        $sql = "DELETE FROM entries
            WHERE id = $id
            AND user_id = $user_id";
    } else {
        $sql = "DELETE FROM entries
            WHERE id = $id";
    }
    $stmt = mysqli_query($con, $sql);
}

header('Location: index.php');
