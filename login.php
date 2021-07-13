<?php

if (isset($_POST)) {
    // Iniciar la conexión a la BD y la sesión y el fichero helpers
    require_once('includes/connect.php');
    require_once('includes/helpers.php');

    // Recoger y sanear los datos del formulario
    $email = !empty($_POST['email-log']) ? mysqli_real_escape_string($con, sanitize($_POST['email-log'])) : false;
    $pass = !empty($_POST['pass-log']) ? sanitize($_POST['pass-log']) : false;

    // Comprobar si hay errores
    $error = '';
    // Campo correo
    if (!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Lo siento, las credenciales no coinciden';
    }
    // Campo contraseña
    if (!$pass) {
        $error = 'Lo siento, las credenciales no coinciden';
    }

    if ($error != '') {
        $_SESSION['log-errors'] = $error;
    } else {
        // Consulta para commprobar las credenciales del usuario
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $stmt = mysqli_query($con, $sql);

        if (mysqli_num_rows($stmt) == 1) {
            $userdata = mysqli_fetch_assoc($stmt);
            // Para comprobar una contraseña cifrada con password_hash() vamos a utilizar la función password_verify(texto introd, texto cifr)
            $checkPass = password_verify($pass, $userdata['pass']);
            if ($checkPass) {
                // Crear una sesión con los datos del usuario
                $_SESSION['userdata'] = $userdata;
            } else {
                $error = 'Lo siento, las credenciales no coinciden';
                if ($error != '') $_SESSION['log-errors'] = $error;
            }
        }
    }
}
// Redirigir a index
header('Location: index.php');
