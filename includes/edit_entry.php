<form class="create-entry" action="saveentry.php" method="post">
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