<?php
require_once('includes/header.php');
?>

<main>
  <section class="news">
    <h3>Últimas noticias</h3>
    <hr class="main-hr" />


    <div class="last-entries" id="lastEntries">
      <?php
      if ($entries = getEntries($con, 4)) :
        while ($entry = mysqli_fetch_assoc($entries)) :
      ?>
          <a href="entry.php?id=<?= $entry['id'] ?>">
            <article>
              <h4 class="news-title"><?= $entry['title'] ?></h4>
              <p class="news-category"><?= $entry['category_name'] ?> <span class="news-date"><?= $entry['entry_date'] ?></span></p>
              <p class="news-body">
                <?= substr($entry['description'], 0, 350) . '...' ?>
              </p>
            </article>
          </a>
      <?php
        endwhile;
      endif;
      ?>
    </div>
    <div class="all-entries" id="allEntries" style="display: none;">
      <?php
      if ($entries = getEntries($con)) :
        while ($entry = mysqli_fetch_assoc($entries)) :
      ?>
          <a href="entry.php?id=<?= $entry['id'] ?>">
            <article>
              <h4 class="news-title"><?= $entry['title'] ?></h4>
              <p class="news-category"><?= $entry['category_name'] ?> <span class="news-date"><?= $entry['entry_date'] ?></span></p>
              <p class="news-body">
              <?= substr($entry['description'], 0, 350) . '...' ?>
              </p>
            </article>
          </a>
      <?php
        endwhile;
      endif;
      ?>
    </div>
    <div>
      <a href="#" class="btn" id="getAllEntries">Ver todas las noticias <i class="fas fa-arrow-right"></i></a>
    </div>
  </section>
  <?php
  require_once('includes/aside.php')
  ?>
</main>
<?php
require_once('includes/footer.php')
?>