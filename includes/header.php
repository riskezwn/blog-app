<?php
require_once('connect.php');
require_once('helpers.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <script src="https://kit.fontawesome.com/790908a15c.js" crossorigin="anonymous"></script>
  <title>Blog</title>
</head>

<body>
  <header>
    <h1>BLOG</h1>
  </header>
  <nav>
    <ul class="ul-nav">
      <li class="li-nav"><a href="#">Inicio</a></li>

      <?php if ($categories = getCategories($con)) :
        while ($category = mysqli_fetch_assoc($categories)) : ?>
          <li class="li-nav"><a href="category.php?id=<?= $category['id']; ?>"><?= $category['name']; ?></a></li>

      <?php
        endwhile;
      endif;
      ?>

      <li class="li-nav"><a href="#">Contacto</a></li>
    </ul>
  </nav>