<?php
require_once('includes/redirect.php');

if (isset($_POST)) {
    require_once('includes/connect.php');
    require_once('includes/helpers.php');

    // Recoger y sanear los datos del formulario
    $title = !empty($_POST['title']) ? mysqli_real_escape_string($con, sanitize($_POST['title'])) : false;
    $category = !empty($_POST['category']) ? (int) mysqli_real_escape_string($con, $_POST['category']) : false;
    $body = !empty($_POST['body']) ? mysqli_real_escape_string($con, $_POST['body']) : false;
    $img = $_FILES['image'];

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
    if ($img['name'] != '') {
        if (!checkImage($img['type'])) {
            $errors['img'] = 'El archivo debe ser una imagen';
        }
    }

    $userdata = $_SESSION['userdata'];
    $user_id = $userdata['id'];
    // Comprobar si hay errores 
    if (count($errors) > 0) {
        $_SESSION['entry_errors'] = $errors;
        if (isset($_GET['edit'])) {
            $entry_id = $_GET['edit'];
            header("Location: edit_entry.php?id=$entry_id");
        } else {
            header("Location: create_entry.php");
        }
    } else {
        $imageUploaded = uploadPhoto($img);

        if (isset($_GET['edit']) && sanitizeNum($con, $_GET['edit'])) {
            $entry_id = $_GET['edit'];
            if ($user_id != 10) {
                $sql = "UPDATE entries SET
                        title = '$title',
                        description = '$body',";
                // Comprueba si se ha subido una imagen o no, para actualizar la base de datos
                if ($imageUploaded != '') {
                    $sql .= "image = '$imageUploaded',";
                }
                $sql .= "category_id = $category
                        WHERE id = $entry_id
                        AND user_id = $user_id;";
            } else {
                $sql = "UPDATE entries SET
                        title = '$title',
                        description = '$body',";
                // Comprueba si se ha subido una imagen o no, para actualizar la base de datos
                if ($imageUploaded != '') {
                    $sql .= "image = '$imageUploaded',";
                }
                $sql .= "category_id = $category
                        WHERE id = $entry_id;";
            }
            $status = 'editado';
        } else {
            $sql = "INSERT INTO entries (title, description, image, category_id, user_id, entry_date)
            VALUES ('$title', '$body', '$imageUploaded', $category, $user_id, CURDATE());";
            $status = 'creado';
        }
        $stmt = mysqli_query($con, $sql);

        if ($stmt) {
            if (!isset($_GET['edit'])) {
                $entry_id = mysqli_insert_id($con);
            }
            $_SESSION['success'] = 'La entrada se ha ' . $status . ' correctamente';
            header("Location: entry.php?id=$entry_id");
        } else {
            $_SESSION['entry_errors']['db'] = 'Error al crear la entrada: ' . mysqli_error($con);
            if (isset($_GET['edit'])) {
                header("Location: edit_entry.php?id=$entry_id");
            } else {
                header("Location: create_entry.php");
            }
        }
    }
    /* if (isset($_GET['edit'])) {
        header('Location: edit_entry.php');
    } else {
        header('Location: create_entry.php');
    } */
} else {
    header('Location:index.php');
}
