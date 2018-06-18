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
      <input type="search" name="search-client" class="form-control" autofocus/>
    </div>
  </div>

  <!-- list des client -->
  <table class="table table-bordered list">
  <thead>
    <tr>
      <th scope="col" >#ID</th>
      <th scope="col" >Nom Complet</th>
      <th scope="col">Email</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row" class="id">1</th>
      <td class="name">Mark</td>
      <td class="email">Otto</td>
      <td>options</td>
    </tr>

  </tbody>
</table>
</div>
<?php
include '../php/includes/foot.php';
?>
