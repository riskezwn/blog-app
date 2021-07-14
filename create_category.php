<?php
require_once('includes/redirect.php');
require_once('includes/header.php');
?>

<main>
  <section class="news">
    <h3>Crear categoría</h3>
    <hr class="main-hr" />

    <form class="create-category " action="savecategory.php" method="post">
      <?php if (isset($_SESSION['category_error'])) {
        echo checkCreateCategoryError($_SESSION['category_error']);
      }
      ?>
      <label for="category_name">Introduce el nombre la categoría que quieres crear</label>
      <input type="text" name="category_name" id="category_name">

      <input class="btn" type="submit" value="Crear">
    </form>
    <?php deleteSession('category_error') ?>
  </section>
  <?php
  require_once('includes/aside.php')
  ?>
</main>

<?php
require_once('includes/footer.php')
?>