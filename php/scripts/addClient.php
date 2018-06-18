<?php
if (isset($_POST['addClient'])) {

    $fn = clear($_POST['fn']);
    $em = clear($_POST['em']);

    $add = $db->prepare('INSERT INTO clients(client_fullname, client_email, createdAt) VALUES(?,?,NOW())');
    if ($add->execute(array($fn, $em))) {
        alert('<strong>Succes</strong>: Utilisateur ajoute avec succes', 'success');
    } else {
        alert();
    }
}
