<?php
$root = true;
$page = 'Creer Newsletter';
$bread = ['Newsletter', 'Creer'];
include './php/includes/head.php';
?>
    <?php include $ind . 'php/scripts/createNews.php';?>

    <form action="./" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="form-group col-md-4 col-xl-3 col-xs-12">
          <label for="img">Attachements</label>
          <input type="file" class="form-control" name="img[]" id="img" multiple required accept="image/*">
        </div>
        <div class="form-group col-md-4 col-xl-3 col-xs-12">
          <label for="sujet">Sujet</label>
          <input type="text" class="form-control" name="sujet" id="sujet" required>
        </div>
        <div class="form-group col-md-4 col-xl-6 col-xs-12">
          <label for="desc">Description</label>
          <input type="text" class="form-control" name="desc" id="desc" required>
        </div>
        <div class="form-group col-12">
          <label for="email">Clients</label>
          <select multiple required class="form-control" name="clients[]" id="exampleFormControlSelect2">
              <?php
$clients = $db->query('SELECT * FROM clients ORDER BY createdAt');

while ($client = $clients->fetch()) {?>
            <option value="<?php echo $client['client_email'] ?>">
            <?php echo $client['client_fullname'] ?> - <?php echo $client['client_email'] ?>
            </option>
<?php }?>
          </select>
          <small class="form-text"><code>(Maintenir <kbd>Ctrl</kbd> pour selectionner plusieurs ulilisateurs et <kbd>Shift</kbd> pour un interval.)</code></small>
        </div>
        <div class="form-group col-12">
          <label for="corps">Corps</label>
          <textarea class="form-control textarea" name="corps" id="corps" required></textarea>
        </div>
      </div>
      <div class="form-group">
      <button type="submit" name="createNews" class="btn btn-primary btn-block">Ajouter</button>
      </div>
    </form>
<?php
include './php/includes/foot.php';
?>
