<?php
require_once('includes/redirect.php');
require_once('includes/header.php');

if (isset($_GET['id']) && sanitizeNum($con, $_GET['id'])) {
  $id = $_GET['id'];
  $entry = getFullEntry($con, $id);
  if (!$entry || ($_SESSION['userdata']['id'] != $entry['user_id'] && $_SESSION['userdata']['id'] != 10)) {
    header('Location: index.php');
  }
} else {
  header('Location: index.php');
}
?>

<main>
  <section class="news">
    <h3>Editar entrada</h3>
    <hr class="main-hr" />

    <form class="create-entry" action="saveentry.php?edit=<?=$id?>" method="post" enctype="multipart/form-data">
      <?php
      if (isset($_SESSION['entry_errors'])) {
        # code...
        $errors = $_SESSION['entry_errors'];
        foreach ($errors as $key => $value) {
          echo checkEntryError($errors, $key);
        }
      }
      ?>
      <div class="form-group">
        <label for="title">Título</label>
        <input type="text" name="title" id="title" value="<?= $entry['title'] ?>">
      </div>
      <div class="form-group">
        <label for="image"><i class="fas fa-camera"></i></label>
        <input type="file" name="image" id="image" value="<?= $entry['image'] ?>">
      </div>
      <div class="form-group">
        <label for="category">Categoría</label>
        <select name="category" id="category">
          <?php
          if ($categories = getCategories($con)) :
            while ($category = mysqli_fetch_assoc($categories)) :
          ?>
              <option value="<?= $category['id'] ?>" <?= $category['id'] == $entry['category_id'] ? 'selected' : ''; ?>><?= $category['name'] ?></option>
          <?php
            endwhile;
          endif;
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="body">Cuerpo de la entrada</label>
        <textarea name="body" id="body" cols="30" rows="10" ><?= $entry['description'] ?></textarea>
      </div>
      <input type="submit" class="btn" value="Editar entrada">
    </form>
    <?php deleteSession('entry_errors'); ?>
  </section>
  <?php
  require_once('includes/aside.php')
  ?>
</main>

<?php
require_once('includes/footer.php')
?>