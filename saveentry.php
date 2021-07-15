<?php
require_once('includes/redirect.php');

if (isset($_POST)) {
    require_once('includes/connect.php');
    require_once('includes/helpers.php');

    // Recoger y sanear los datos del formulario
    $title = !empty($_POST['title']) ? mysqli_real_escape_string($con, sanitize($_POST['title'])) : false;
    $category = !empty($_POST['category']) ? (int) mysqli_real_escape_string($con, sanitize($_POST['category'])) : false;
    $body = !empty($_POST['body']) ? mysqli_real_escape_string($con, sanitize($_POST['body'])) : false;

    // Validar los datos
    $errors = [];
    // Campo titulo
    if (!is_string($title) || !preg_match('/^[A-Za-zÀ-ÿ0-9 ]+$/', $title)) {
        $errors['title'] = 'El título no es válido';
    }
    // Campo categoria
    if (!is_int($category) || !filter_var($category, FILTER_VALIDATE_INT)) {
        $errors['category'] = 'La categoría no es válida';
    }
    // Campo body
    if (!is_string($body) || empty($body)) {
        $errors['body'] = 'El cuerpo de la entrada no puede estar vacío';
    }

    // Comprobar si hay errores 
    if (count($errors) > 0) {
        $_SESSION['entry_errors'] = $errors;
    } else {
        $userdata = $_SESSION['userdata'];
        $user_id = $userdata['id'];
        if (isset($_GET['edit']) && sanitizeNum($con, $_GET['edit'])) {
            $entry_id = $_GET['edit'];
            $sql = "UPDATE entries SET
                    title = $title,
                    description = $description,
                    category_id = $category
                    WHERE id = $id
                    AND user_id = $user_id";
            $stmt = mysqli_query($con, $sql);
        } else {
            $sql = "INSERT INTO entries (title, description, category_id, user_id, entry_date)
            VALUES ('$title', '$body', $category, $user_id, CURDATE());";

            $stmt = mysqli_query($con, $sql);

            if ($stmt) {
                $_SESSION['success'] = 'La entrada se ha creado correctamente';
            } else {
                $_SESSION['entry_errors']['db'] = 'Error al crear la entrada';
            }
        }
    }
    if (isset($_GET['edit'])) {
        header('Location: edit_entry.php');
    } else {
        header('Location: create_entry.php');
    }
}
header('Location: index.php');
