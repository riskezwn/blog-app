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
function sanitizeNum($con, $num)
{
    $num = (int) mysqli_real_escape_string($con, sanitize($num));
    $result = false;
    if (is_int($num)) {
        $result = true;
    }
    return $result;
}
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

// Devuelve las 'n' últimas entradas
// Parametrizar una función es añadirle parámetros para que realice otras acciones
function getEntries($con, $limit = null, $category = null)
{
    $sql = "SELECT entries.*,
            UPPER(categories.name) AS category_name,
            DATE_FORMAT(entries.entry_date, '%d-%m-%Y') AS entry_date
            FROM entries 
                INNER JOIN categories ON entries.category_id = categories.id ";
    if (isset($category)) {
        $sql .= "WHERE entries.category_id = $category ";
    }
    $sql .= "ORDER BY entries.entry_date DESC ";
    if (isset($limit)) {
        $sql .= "LIMIT $limit;";
    }

    $stmt = mysqli_query($con, $sql);
    $result = false;
    if ($stmt && mysqli_num_rows($stmt) >= 1) {
        $result = $stmt;
    }
    return $result;
}
// Devuelve el contenido de un registro de la tabla entries
function getFullEntry($con, $id)
{
    $sql = "SELECT entries.*,
    CONCAT(users.name, ' ', users.subname) AS author,
    DATE_FORMAT(entries.entry_date, '%d-%m-%Y') AS entry_date,
    UPPER(categories.name) AS category

    FROM entries
        INNER JOIN categories ON entries.category_id = categories.id
        INNER JOIN users ON entries.user_id = users.id
    HAVING entries.id = $id";

    $stmt = mysqli_query($con, $sql);
    $result = false;
    if ($stmt && mysqli_num_rows($stmt) == 1) {
        $result = mysqli_fetch_assoc($stmt);
    }
    return $result;
}

// Devuelve entradas desde busqueda

function searchEntries($con, $txt)
{
    $sql = "SELECT entries.*,
    CONCAT(users.name, ' ', users.subname) AS author,
    DATE_FORMAT(entries.entry_date, '%d-%m-%Y') AS entry_date,
    UPPER(categories.name) AS category
    FROM entries
        INNER JOIN categories ON entries.category_id = categories.id
        INNER JOIN users ON entries.user_id = users.id
    WHERE title LIKE '%$txt%'
    OR description LIKE '%$txt%'
    ORDER BY entry_date DESC;";

    $stmt = mysqli_query($con, $sql);
    $result = false;
    if ($stmt && mysqli_num_rows($stmt) >= 1) {
        $result = $stmt;
    }
    return $result;
}

function setUserImage($con, $img, $user_id)
{
    $sql = "UPDATE users SET user_image = '$img' WHERE id = $user_id";
    $stmt = mysqli_query($con, $sql);

    $result = false;
    if ($stmt) {
        $result = true;
    }
    return $result;
}
function uploadPhoto($img)
{
    if (isset($img) && $img != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $type = $img['type'];
        $temp = $img['tmp_name'];

        $errors = [];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")))) {
            $errors[] = '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
         - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
        } else {
            $result = null;
            $upload_dir = 'assets/images/';
            $upload_file_name = 'entryimage' . time() . '.jpg';
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
            if (move_uploaded_file($temp, $upload_dir . $upload_file_name)) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod($upload_dir . $upload_file_name, 0777); 
                $result = $upload_file_name ;
            } 
        }
    }
    return $result;
}
function checkImage($type) {
    $result = false;
    if (strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")) {
        $result = true;
    }
    return $result;
}