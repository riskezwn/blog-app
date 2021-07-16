<?php

require_once('redirect.php');
require_once('connect.php');
require_once('helpers.php');

$user_id = $_SESSION['userdata']['id'];

//Si se quiere subir una imagen
if (isset($_POST)) {
    //Recogemos el archivo enviado por el formulario
    $file = $_FILES['profilephoto'];
    if (isset($file) && $file != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $type = $_FILES['profilephoto']['type'];
        $size = $_FILES['profilephoto']['size'];
        $temp = $_FILES['profilephoto']['tmp_name'];

        $errors = [];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")))) {
            $errors[] = '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
         - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
        } else {

            if (isset($_POST['userphoto'])) {
                $upload_dir = '../assets/images/user_images/';
                $upload_file_name = 'profilephoto' . time() . '.jpg';
                //Si la imagen es correcta en tamaño y tipo
                //Se intenta subir al servidor
                if (move_uploaded_file($temp, $upload_dir . $upload_file_name)) {
                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                    chmod($upload_dir . $upload_file_name, 0777);
                    //Subir imagen a db
                    if (setUserImage($con, $upload_file_name, $user_id )) {
                        $_SESSION['userdata']['user_image'] = $upload_file_name;
                        header('Location: ../profile.php');
                    } else {
                        $errors[] = '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                    
                        echo mysqli_error($con);
                        die();
                    }
                } else {
                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                    $errors[] = '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                }
            }
        }
    }
}
