<?php


if (isset($_POST)) {
    require_once('includes/connect.php');
    require_once('includes/helpers.php');
    // Recoger y sanear los datos del formulario
    // Para evitar ataques de inyección SQL utilizaremos la función de mysqli_real_escape_string($conexion, $dato)

    $name = !empty($_POST['name']) ? mysqli_real_escape_string($con, sanitize($_POST['name'])) : false;
    $subname = !empty($_POST['subname']) ? mysqli_real_escape_string($con, sanitize($_POST['subname'])) : false;
    $email = !empty($_POST['email']) ? mysqli_real_escape_string($con, sanitize($_POST['email'])) : false;
    $pass = !empty($_POST['pass']) ? sanitize($_POST['pass']) : false;

    /// Validar los datos ///
    $errors = [];
    // Campo nombre
    if (!is_string($name) || !preg_match('/^[A-Za-zÀ-ÿ ]+$/', $name)) {
        $errors['name'] = 'El nombre no es válido';
    }
    // Campo apellido
    if (!is_string($subname) || !preg_match('/^[A-Za-zÀ-ÿ ]+$/', $subname)) {
        $errors['subname'] = 'Los apellidos no son válidos';
    }
    // Campo correo
    if (!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !checkDBEmail($con, $email)) {
        $errors['email'] = 'El email no es válido o ya existe';
    }
    // Campo contraseña
    if (!$pass || strlen($pass) < 8) {
        $errors['pass'] = 'La contraseña debe tener al menos 8 caracteres';
    }

    /// Comprobar si hay errores ///
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
    } else {
        // Cifrar la contraseña y guardar el registro. Para cifrar la contraseña, en vez de md5 o sha1, utilizaremos la función password_hash(contraseña, metodo, coste)
        $secure_pass = password_hash($pass, PASSWORD_DEFAULT);

        // Insertar usuario en la base de datos
        $sql = "INSERT INTO users (name, subname, email, pass, signup_date) VALUES ('$name', '$subname', '$email', '$secure_pass', CURDATE())";
        $stmt = mysqli_query($con, $sql);

        if ($stmt) {
            $_SESSION['signup'] = 'El registro se ha completado correctamente';
        } else {
            $_SESSION['errors']['signup'] = 'Fallo al crear el usuario: ' . mysqli_error($con);
        }
    }
}
// Redirigir a index
header('Location: index.php');
