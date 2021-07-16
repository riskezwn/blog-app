<?php

require_once('redirect.php');
require_once('helpers.php');


//Si se quiere subir una imagen
if (isset($_POST)) {
    //Recogemos el archivo enviado por el formulario
    $file = $_FILES['profilephoto'];
    if (isset($file) && $file != "") {
       //Obtenemos algunos datos necesarios sobre el archivo
       $type = $_FILES['profilephoto']['type'];
       $size = $_FILES['profilephoto']['size'];
       $temp = $_FILES['profilephoto']['tmp_name'];
       //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
      if (!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")))) {
         echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
         - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
      }
      else {
         $upload_dir = '../assets/images/';
         $upload_file_name = 'profilephoto'. time() . '.jpg';
         //Si la imagen es correcta en tamaño y tipo
         //Se intenta subir al servidor
         if (move_uploaded_file($temp, $upload_dir.$upload_file_name)) {
             //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
             chmod($upload_dir.$upload_file_name, 0777);
             //Mostramos el mensaje de que se ha subido co éxito
             echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
             //Mostramos la imagen subida
             echo '<p><img src="'.$upload_dir.$upload_file_name.'"></p>';
         }
         else {
            //Si no se ha podido subir la imagen, mostramos un mensaje de error
            echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
         }
       }
    }
 }