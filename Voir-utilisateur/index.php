<?php
$page = 'Voir Client';
$bread = ['Client', 'Voir'];
include '../php/includes/head.php';
?>
<div id="list-client">

  <!-- client bar de recherche -->
  <div class="form-group">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text bg-white" id="basic-addon1">Rechercher dans clients</span>
      </div>
      <input type="search" name="search-client" class="form-control search" autofocus/>
    </div>
  </div>

  <!-- list des client -->
  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" >#ID</th>
      <th scope="col">Nom Complet</th>
      <th scope="col">Email</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody class="list">
  <?php
$clients = $db->query('SELECT * FROM clients ORDER BY createdAt');

while ($client = $clients->fetch()) {?>
    <tr>
      <th scope="row" class="id"><?php echo $client['client_id'] ?></th>
      <td class="name"><?php echo $client['client_fullname'] ?></td>
      <td class="email"><?php echo $client['client_email'] ?></td>
      <td>options</td>
    </tr>
  <?php }?>
  </tbody>
</table>
</div>

<script>
  jQuery(document).ready(function(){
    var opt = { valueNames: ['id', 'name', 'email'] };
    var clientList = new List('list-client', opt);
  });
</script>
<?php
include '../php/includes/foot.php';
?>
