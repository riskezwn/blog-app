<aside class="sign-in-up">

  <?php if (isset($_SESSION['userdata'])) : ?>
    <div class="container session">

      <?php

      $user = $_SESSION['userdata'];

      $user_name = $user['name'];
      $user_subname = $user['subname'];
      $user_image = $user['user_image'];

      // image
      $path = $_SERVER['PHP_SELF'];
      $filePath = basename($path, '.php');

      ?>
      <div class="user">
        <h4>¡Bienvenido <?= $user_name ?>!</h4>
        <img src="assets/images/user_images/<?= $user_image ?>" class="user-image" alt="user avatar">
      </div>
      <ul class="user-options">
        <li class="option"><a href="index.php"><i class="fas fa-user-alt"></i> Mi perfil</a></li>
        <li class="option"><a href="create_entry.php"><i class="fas fa-pencil-alt"></i> Escribir entrada</a></li>
        <li class="option"><a href="create_category.php"><i class="fas fa-pencil-ruler"></i> Crear categoría</a></li>
        <li class="option"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
      </ul>
    </div>
  <?php else : ?>
    <div class="container sign-in">
      <h5>inicia sesión</h5>
      <form action="login.php" method="POST">
        <?php
        if (isset($_SESSION['log-errors'])) echo checkLoginError($_SESSION['log-errors']);

        ?>
        <label for="email-log">Email</label>
        <div class="form-group">
          <i class="fas fa-user"></i>
          <input type="email" name="email-log" id="email-log" placeholder="user@example.com" />
        </div>
        <label for="pass-log">Contraseña</label>
        <div class="form-group">
          <i class="fas fa-lock"></i>
          <input type="password" name="pass-log" id="pass-log" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" />
        </div>
        <input type="submit" class="btn" value="LOG IN" />
      </form>
    </div>
    <div class="container">
      <h5>o regístrate</h5>
      <form action="registro.php" class="sign-up" method="POST">
        <!-- Mostrar el resultado del registro -->
        <?php if (isset($_SESSION['signup'])) : ?>
          <div class="success"><i class="fas fa-check-circle"></i><?= $_SESSION['signup'] ?></div>
        <?php elseif (isset($_SESSION['errors']['signup'])) : ?>
          <div class="error form"><i class='fas fa-exclamation-circle'></i><?= $_SESSION['errors']['signup'] ?></div>
        <?php endif; ?>
        <label for="name">Nombre</label>
        <div class="form-group">
          <input type="text" name="name" id="name" placeholder="John" />
        </div>
        <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'name');
        ?>
        <label for="subname">Apellidos</label>
        <div class="form-group">
          <input type="text" name="subname" id="subname" placeholder="Doe" />
        </div>
        <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'subname');
        ?>
        <label for="email">Email</label>
        <div class="form-group">
          <input type="email" name="email" id="email" placeholder="user@example.com" />
        </div>
        <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'email');
        ?>
        <label for="pass">Contraseña</label>
        <div class="form-group">
          <input type="password" name="pass" id="pass" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" />
        </div>
        <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'pass');
        ?>
        <input type="submit" class="btn" value="SIGN UP" />
      </form>
      <?php
      deleteSession('errors');
      deleteSession('log-errors');
      deleteSession('signup');
      ?>
    </div>
  <?php endif; ?>
  <img src="assets/images/<?= $filePath ?>.svg" alt="newspaper" class="img" />
</aside>