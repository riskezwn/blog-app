<?php

// Sanear las entradas de un formulario para evitar ataques Xsiting
function sanitize($v)
{   $v = trim($v);
    $v = strip_tags($v);
    return $v;
}

// Muestra los errores según la clave en un formulario
function checkFormError($errors, $field)
{
    $result = '';
    if (isset($errors[$field]) && !empty($field)) {
        $result = "<div class='form-error'><i class='fas fa-exclamation-circle'></i>$errors[$field]</div>";
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
