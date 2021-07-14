<?php
require_once('includes/redirect.php');
require_once('includes/header.php');
$user = $_SESSION['userdata'];

$user_name = $user['name'];
$user_subname = $user['subname'];
$user_image = $user['user_image'];
?>

<main class="profile-container">

  <div class="profile">
    <?php
    if (isset($_SESSION['modifyuser'])) {
      echo checkCreateCategoryError('success', $_SESSION['modifyuser']);
    }
    ?>
    <img src="./assets/images/user_images/<?= $user_image ?>" alt="">
    <h4><?= $user_name ?> <?= $user_subname ?></h4>
    <hr class="main-hr">
    <form action="modifyuser.php" method="post">
    <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'modifyuser');
        ?>
    <label for="name">Nombre</label>
        <div class="form-group">
          <input type="text" name="name" id="name" placeholder="John" value="<?=$user_name?>" />
        </div>
        <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'name');
        ?>
        <label for="subname">Apellidos</label>
        <div class="form-group">
          <input type="text" name="subname" id="subname" placeholder="Doe" value="<?=$user_subname?>" />
        </div>
        <?php
        if (isset($_SESSION['errors'])) echo checkFormError($_SESSION['errors'], 'subname');
        ?>
        <input type="submit" value="Actualizar" class="btn">
    </form>
    <?php deleteSession('errors');
    deleteSession('modifyuser'); ?>
  </div>
  <h2>Mi perfil</h2>
</main>

<?php
require_once('includes/footer.php')
?>