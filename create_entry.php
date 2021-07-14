<?php
require_once('includes/redirect.php');
require_once('includes/header.php');
?>

<main>
  <section class="news">
    <h3>Escribe una nueva entrada</h3>
    <hr class="main-hr" />

    <form class="create-entry" action="saveentry.php" method="post">
      <div class="form-group">
        <label for="title">Título</label>
        <input type="text" name="title" id="title">
      </div>
      <div class="form-group">
        <label for="category">Categoría</label>
        <select name="category" id="category">
          <?php 
            if ($categories = getCategories($con)) :
              while ($category = mysqli_fetch_assoc($categories)) :
          ?>
          <option value="<?=$category['id']?>"><?=$category['name']?></option>
          <?php
              endwhile;
            endif;
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="body">Cuerpo de la entrada</label>
        <textarea name="body" id="body" cols="30" rows="10"></textarea>
      </div>
      <input type="submit" class="btn" value="Crear entrada">
    </form>
  </section>
  <?php
  require_once('includes/aside.php')
  ?>
</main>

<?php
require_once('includes/footer.php')
?>