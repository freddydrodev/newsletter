<?php
if (isset($_POST['createNews'])) {

    $sujet = clear($_POST['sujet']);
    $desc = clear($_POST['desc']);
    $clients = $_POST['clients'];
    $corps = clear($_POST['corps']);
    $img = $_FILES["img"];
    $ok = true;

    if (isset($_FILES)) {

        // file check
        $target_dir = $ind . "assets/images/";
        $target_file = $target_dir . basename($img["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        $check = getimagesize($img["tmp_name"]);
        if ($check == false) {
            $ok = false;
            alert('Fichier n\'est pas une image - ' . $check["mime"] . '.');
        }
        // Check if file already exists
        // if (file_exists($target_file)) {
        //     // $ok = false;
        //     echo "Sorry, file already exists.";
        // }
        // Check file size
        if ($img["size"] > 4194304) {
            $ok = false;
            alert('Desole l\'image est trop lourde elle doit etre moins de 4Mo');
        }
        // Allow certain file formats
        if (strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg") {
            $ok = false;
            alert('Desole le fichier n\'est pas une image (JPG, JPEG, PNG)');
        }
    } else {
        alert('Image: Aucune Image Ajoutee');
    }

    //check data
    if (strlen($sujet) <= 0) {
        $ok = false;
        alert('<strong>Sujet</strong>: doit contenir au moins 1 caractere.');
    }
    if (strlen($desc) <= 0) {
        $ok = false;
        alert('<strong>Description</strong>: doit contenir au moins 1 caractere.');
    }
    if (strlen($corps) <= 0) {
        $ok = false;
        alert('<strong>Corps</strong>: doit contenir au moins 1 caractere.');
    }
    if (count($clients) <= 0) {
        $ok = false;
        alert('<strong>Clients</strong>: doit contenir au moins 1 client.');
    }

    if ($ok) {
        $date = new DateTime();
        echo $date->getTimestamp();

        $n = 'Article_' . $date->getTimestamp() . '.jpg';
        $dest = $target_dir . $n;
        if (move_uploaded_file($img["tmp_name"], $dest)) {
            alert('success: Newsletter envoyee!', 'success');

        } else {
            alert('erreur: Image ajoute!');
        }

    }

}
