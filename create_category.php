<?php
require_once('includes/redirect.php');
require_once('includes/header.php');

if ($_SESSION['userdata']['id'] == 10) : ?>

<main>
  <section class="news">
    <h3>Crear categoría</h3>
    <hr class="main-hr" />

    <form class="create-category " action="savecategory.php" method="post">
      <?php if (isset($_SESSION['category_error'])) {
        echo checkCreateCategoryError('error', $_SESSION['category_error']);
      } elseif (isset($_SESSION['category_success'])) {
        echo checkCreateCategoryError('success', $_SESSION['category_success']);
      }
      ?>
      <label for="category_name">Introduce el nombre la categoría que quieres crear</label>
      <input type="text" name="category_name" id="category_name">

      <input class="btn" type="submit" value="Crear">
    </form>
    <?php deleteSession('category_error');
          deleteSession('category_success');
    ?>
  </section>
  <?php
  require_once('includes/aside.php')
  ?>
</main>

<?php
require_once('includes/footer.php');

else :
  header('Location: index.php');
endif;
?>