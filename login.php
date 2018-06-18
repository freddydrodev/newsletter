<?php
if (isset($_POST['login'])) {
    if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $user = trim(htmlspecialchars($_POST['username']));
        $pass = sha1(trim(htmlspecialchars($_POST['password'])));

        if ($user === 'admin' && $pass === sha1('admin')) {
            $_SESSION['id'] = 'admin';

            header('location: create-newsletter/');
        } else {
            echo '<div class="alert alert-danger" role="alert">
                Erreur! Mot de passe et nom d\'utilisateur ne correspondent pas
              </div>';
        }
    }
}
