<?php
if($menu){
  echo menu($menu, 'Voir Site Web', $ind);
}
?>
  <div class="container" id="main-container">
<?php
if (isset($bread)) {
    echo bread($bread);
}
?>