<?php
require_once('includes/header.php');

if (isset($_GET['id']) && sanitizeNum($con, $_GET['id'])) {
  $entry_id = (int) $_GET['id'];
  $entry = getFullEntry($con, $entry_id);
} else {
  header('Location: index.php');
}


?>

<main class="entry-container" id="entry">
  <div class="entry" id="entry">
    <?php if (isset($_SESSION['success'])) {
      echo checkCreateCategoryError('success', $_SESSION['success']);
    }
    ?>
    <?php if (isset($_SESSION['userdata'])) : 
            if ($_SESSION['userdata']['id'] == $entry['user_id'] || $_SESSION['userdata']['id'] == 10) : 
    ?>
    <div class="buttons">
      <a href="edit_entry.php?id=<?= $entry_id ?>" id="edit-button"><i class="fas fa-edit"></i></a>
      <a href="delete_entry.php?id=<?= $entry_id ?>" id="delete-button"><i class="fas fa-trash"></i></a>
    </div>
    <?php   endif;
          endif; 
    ?>
    <h3 class="title"><?= $entry['title'] ?></h3>
    <div class="info">
      <a href="category.php?id=<?= $entry['category_id'] ?>"><div class="category"><?= $entry['category'] ?></div></a>
      <a href="user_entries.php?id=<?= $entry['user_id'] ?>"><div class="author"><?= $entry['author'] ?></div></a>
      <div class="date"><?= $entry['entry_date'] ?></div>
    </div>
    <?php if ($entry['image'] != '') : ?> 
    <img class="image" src="assets/images/<?= $entry['image']?>" alt="entry_image" >
    <?php endif; ?>
    <p class="body">
      <?= $entry['description'] ?>
    </p>

    <a href="#entry" class="top"><i class="fas fa-long-arrow-alt-up"></i> Volver arriba</a>
  </div>

</main>

<?php
deleteSession('success');
require_once('includes/footer.php')
?>