<?php

// Sanear las entradas de un formulario para evitar ataques Xsiting
function sanitize($v)
{
    $v = trim($v);
    $v = strip_tags($v);
    return $v;
}

// Muestra los errores según la clave en un formulario
function checkFormError($errors, $field)
{
    $result = '';
    if (isset($errors[$field]) && !empty($field)) {
        $result = "<div class='error form'><i class='fas fa-exclamation-circle'></i>$errors[$field]</div>";
    }
    return $result;
}
function checkLoginError($errors)
{
    $result = '';
    if (isset($errors)) {
        $result = "<div class='error'><i class='fas fa-exclamation-circle'></i>$errors</div>";
    }
    return $result;
}

// Elimina las variables de sesión
function deleteSession($session)
{
    if (isset($_SESSION[$session])) {
        unset($_SESSION[$session]);
    }
}


// ********************* BASE DE DATOS ********************* //

// Devuelve las categorias de la base de datos
function getCategories($con)
{
    $sql = "SELECT * FROM categories;";
    $stmt = mysqli_query($con, $sql);

    $result = false;
    if ($stmt && mysqli_num_rows($stmt) > 1) {
        $result = $stmt;
    }
    return $result;
}

// Devuelve las 4 últimas entradas
function getLastEntries($con)
{
    $sql = "SELECT entries.*,
            categories.name AS category_name,
            DATE_FORMAT(entries.entry_date, '%d-%m-%Y') AS entry_date
            FROM entries 
                INNER JOIN categories ON entries.category_id = categories.id 
            ORDER BY entries.entry_date DESC LIMIT 4;";
    $stmt = mysqli_query($con, $sql);
    $result = false;
    if ($stmt && mysqli_num_rows($stmt) > 1) {
        $result = $stmt;
    }
    return $result;
}
