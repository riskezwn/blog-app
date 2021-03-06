<?php
require_once('includes/redirect.php');

if (isset($_POST)) {
    require_once('includes/connect.php');
    require_once('includes/helpers.php');

    // Recoger y sanear los datos del formulario
    $name = !empty($_POST['category_name']) ? mysqli_real_escape_string($con, sanitize($_POST['category_name'])) : false;

    // Validar los datos
    if (!is_string($name) || !preg_match('/^[A-Za-zÀ-ÿ0-9 ]+$/', $name)) {
        $_SESSION['category_error'] = 'Ya existe una categoría con ese nombre o has especificado un nombre no válido';
        header('Location: create_category.php');
    } else {
        // Guardar los datos en la base de datos
        $sql = "INSERT INTO categories (name)
                VALUES ('$name');";
        $stmt = mysqli_query($con, $sql);
        
        if ($stmt) {
            $_SESSION['category_success'] = 'La categoría se ha creado correctamente';
        } else {
            $_SESSION['category_error'] = 'Ya existe una categoría con ese nombre o has especificado un nombre no válido';
        }
    }
}
// Redirigir a index
header('Location: create_category.php');

