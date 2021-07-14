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
        $result = "<div class='error'><i class='fas fa-exclamation-circle'></i> $errors</div>";
    }
    return $result;
}
function checkCreateCategoryError($status, $msg)
{
    $result = '';
    if (isset($msg) && $status == 'error') {
        $result = "<div class='category-error'><i class='fas fa-exclamation-circle'></i> $msg</div>";
    } elseif (isset($msg) && $status == 'success') {
        $result = "<div class='category-success'><i class='fas fa-exclamation-circle'></i> $msg</div>";
    }
    return $result;
}
function checkEntryError($errors, $field)
{
    $result = '';
    if (isset($errors[$field]) && !empty($field)) {
        $result = "<div class='category-error'><i class='fas fa-exclamation-circle'></i> $errors[$field]</div>";
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
// Devuelve el nombre de la categoria a traves de su id
function getCategoryName($con, int $id)
{
    $sql = "SELECT name
            FROM categories
            WHERE id = $id;";
    $stmt = mysqli_query($con, $sql);

    $result = false;
    if (mysqli_num_rows($stmt) == 1) {
        $result = mysqli_fetch_assoc($stmt);
        $result = $result['name'];
    }
    return $result;
}

// Devuelve las 4 últimas entradas
// Parametrizar una función es añadirle parámetros para que realice otras acciones
function getEntries($con, $limit = null, $category = null)
{
    $sql = "SELECT entries.*,
            UPPER(categories.name) AS category_name,
            DATE_FORMAT(entries.entry_date, '%d-%m-%Y') AS entry_date
            FROM entries 
                INNER JOIN categories ON entries.category_id = categories.id ";
    if (isset($category)) {
        $sql .= "HAVING entries.category_id = $category ";
    }
    $sql .= "ORDER BY entries.entry_date DESC ";
    if (isset($limit)) {
        $sql .= "LIMIT $limit;";
    }

    $stmt = mysqli_query($con, $sql);
    $result = false;
    if ($stmt && mysqli_num_rows($stmt) > 1) {
        $result = $stmt;
    }
    return $result;
}
