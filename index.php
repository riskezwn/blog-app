<?php
require_once('includes/header.php');
?>

<main>
  <section class="news">
    <h3>Últimas noticias</h3>
    <hr class="main-hr" />


    <?php
    if ($entries = getLastEntries($con)) :
      while ($entry = mysqli_fetch_assoc($entries)) :
    ?>
        <a href="entry.php?id=<?= $entry['id'] ?>">
          <article>
            <h4 class="news-title"><?= $entry['title'] ?></h4>
            <p class="news-category"><?= $entry['category_name'] ?> <span class="news-date"><?= $entry['entry_date'] ?></span></p>
            <p class="news-body">
              <?= $entry['description'] ?>
            </p>
          </article>
        </a>
    <?php
      endwhile;
    endif;
    ?>
    <div>
      <a href="#" class="btn">Ver todas las noticias <i class="fas fa-arrow-right"></i></a>
    </div>
  </section>
  <?php
  require_once('includes/aside.php')
  ?>
</main>

<?php
require_once('includes/footer.php')
?>