<?php
require_once('includes/redirect.php');
require_once('includes/header.php');
$user = $_SESSION['userdata'];

$user_name = $user['name'];
$user_subname = $user['subname'];
$user_email = $user['email'];
$user_image = $user['user_image'];
?>

<main class="profile-container">
  <section>

    <div class="profile">
      <h2>Mi perfil</h2>
      <?php
      if (isset($_SESSION['modifyuser'])) {
        echo checkCreateCategoryError('success', $_SESSION['modifyuser']);
      }
      ?>
      <img src="./assets/images/user_images/<?= $user_image ?>" alt="">

      <form enctype="multipart/form-data" action="includes/upload.php" method="POST">
        <div class="form-group">
          <label for="profilephoto"><i class="fas fa-camera"></i></label>
          <input type="file" name="profilephoto" id="profilephoto">
        </div>
        <input type="hidden" name="userphoto">
        <input type="submit" value="Subir">
      </form>

      <h4><?= $user_name ?> <?= $user_subname ?></h4>
      <form class="create-entry" action="modifyuser.php" method="post">
        <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'modifyuser');
        ?>
        <label for="name">Nombre</label>
        <div class="form-group">
          <input type="text" name="name" id="name" placeholder="John" value="<?= $user_name ?>" />
        </div>
        <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'name');
        ?>
        <label for="subname">Apellidos</label>
        <div class="form-group">
          <input type="text" name="subname" id="subname" placeholder="Doe" value="<?= $user_subname ?>" />
        </div>
        <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'subname');
        ?>
        <label for="email">Email</label>
        <div class="form-group">
          <input type="email" name="email" id="email" placeholder="user@example.com" value="<?= $user_email ?>" />
        </div>
        <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'email');
        ?>
        <label for="pass">Contraseña</label>
        <div class="form-group">
          <input type="password" name="pass" id="pass" placeholder="" />
        </div>
        <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'pass');
        ?>
        <input type="submit" value="Actualizar" class="btn">
      </form>
      <?php deleteSession('errors');
      deleteSession('modifyuser'); ?>
    </div>
  </section>

</main>

<?php
require_once('includes/footer.php')
?>