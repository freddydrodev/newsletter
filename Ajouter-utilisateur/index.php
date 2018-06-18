<?php
$page = 'Ajouter Client';
$bread = ['Client', 'Ajouter'];
include '../php/includes/head.php';
?>
    <?php include $ind . 'php/scripts/addClient.php';?>
    <form action="./" method="post">
      <div class="row">
        <div class="form-group col-sm-6 col-xs-12">
          <label for="fullname">Nom Complet</label>
          <input type="text" class="form-control" name="fn" id="fullname" required>
        </div>
        <div class="form-group col-sm-6 col-xs-12">
          <label for="email">Email Addresse</label>
          <input type="email" class="form-control" name="em" id="email" required>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" name="addClient" class="btn btn-primary btn-block">Ajouter</button>
      </div>
    </form>
<?php
include '../php/includes/foot.php';
?>
