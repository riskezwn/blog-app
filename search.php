<?php
require_once('includes/header.php');

if (isset($_POST)) {
  $searchText = mysqli_real_escape_string($con, sanitize($_POST['search']));
} else {
  header('Location: index.php');
}


?>

<main>
  <section class="news">
    <h3>Entradas con "<?= $searchText ?>":</h3>
    <hr class="main-hr" />




    <?php
    if ($entries = searchEntries($con, $searchText)) :
      while ($entry = mysqli_fetch_assoc($entries)) :
    ?>
        <a href="entry.php?id=<?= $entry['id'] ?>">
          <article>
            <h4 class="news-title"><?= $entry['title'] ?></h4>
            <p class="news-category"><?= $entry['category'] ?> <span class="news-date"><?= $entry['entry_date'] ?></span></p>
            <p class="news-body">
              <?= substr($entry['description'], 0, 350) . '...' ?>
            </p>
          </article>
        </a>

      <?php
      endwhile;
    else :
      ?>
      <p class="empty-entries">Nada que ver por aquí...</p>
    <?php
    endif;
    ?>
    </div>

  </section>
  <?php
  require_once('includes/aside.php')
  ?>
</main>
<?php
require_once('includes/footer.php')
?>