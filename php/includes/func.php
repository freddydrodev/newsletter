<?php
//generate breadcrumb
function bread($ar = [])
{
    $ar_count = count($ar);
    $output = '';
    if ($ar_count > 0) {
        $output = '<nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-light rounded-0 mt-3">';

        for ($i = 0; $ar_count > $i; $i++) {
            if ($i === $ar_count - 1) {
                $output .= '<li class="breadcrumb-item active" aria-current="page">' . $ar[$i] . '</li>';
            } else {
                $output .= '<li class="breadcrumb-item">' . $ar[$i] . '</li>';
            }
        }

        $output .= '</ol>
      </nav>';
    }

    return $output;
}

//clear data in send from a formular
function clear($in)
{
    return trim(htmlspecialchars($in));
}

//create a menu with active mode
function menu($menu = [], $active = '', $ind)
{
    $menu_keys = array_keys($menu);
    $out = '<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom w-100 fixed-top">
    <a class="navbar-brand" href="#">Batir SA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between w-100" id="navbarNavDropdown">
      <ul class="navbar-nav">';

    function createSubLink($ar = [], $ind)
    {
        $_ = '';
        foreach ($ar as $key => $val) {
            $_ .= '<a class="dropdown-item" href="' . $ind . $val . '">' . $key . '</a>';
        }
        return $_;
    }

    foreach ($menu_keys as $key => $data) {
        if (is_array($menu[$data])) {
            $out .= '<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle active" href="#" id="' . str_replace(' ', '-', $data) . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    ' . $data . '
  </a>
  <div class="dropdown-menu" aria-labelledby="' . str_replace(' ', '-', $data) . '">
    ' . createSubLink($menu[$data], $ind) . '
  </div>
</li>';
        } else {
            $out .= '<li class="nav-item">
       <a class="nav-link" href="' . $ind . $menu[$data] . '">' . $data . '<span class="sr-only">(current)</span></a>
       </li>';
        }
    }

    $out .= '</ul>
      <div class="right-block navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Diomande Dro Freddy Junior</a>
        </li>
        <li class="nav-item border-left">
          <a class="nav-link" href="#">Deconnection</a>
        </li>
      </div>
    </div>
  </nav>';

    return $out;
}

function alert($msg = 'Erreur Inconnue', $type = 'danger')
{

    echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
  ' . $msg . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
