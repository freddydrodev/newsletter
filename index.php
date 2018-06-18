<?php
$root = true;
$page = 'Creer Newsletter';
$bread = ['Newsletter', 'Creer'];
include './php/includes/head.php';
?>
    <form action="#" method="post">
      <div class="row">
        <div class="form-group col-sm-6 col-xs-12">
          <label for="fullname">Nom Complet</label>
          <input type="text" class="form-control" name="fullname" id="fullname" required>
        </div>
        <div class="form-group col-sm-6 col-xs-12">
          <label for="email">Email Addresse</label>
          <input type="email" class="form-control" name="email" id="email" required>
        </div>
      </div>
      <div class="form-group">
      <button type="submit" name="addUser" class="btn btn-primary btn-block">Ajouter</button>
      </div>
    </form>
  </div>
<?php
include './php/includes/foot.php';
?>
