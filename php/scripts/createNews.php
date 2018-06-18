<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['createNews'])) {

    $sujet = clear($_POST['sujet']);
    $desc = clear($_POST['desc']);
    $clients = $_POST['clients'];
    $corps = clear($_POST['corps']);
    $img = $_FILES["img"];
    $ok = true;

    if (isset($_FILES) && !empty($_FILES)) {

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

        $n = 'Article_' . $date->getTimestamp() . '.jpg';
        $dest = $target_dir . $n;
        // if (move_uploaded_file($img["tmp_name"], $dest)) {

        //send the email
        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        try {
            //Server settings
            // $mail->SMTPDebug = 1; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'frediustc@gmail.com'; // SMTP username
            $mail->Password = 'resurection'; // SMTP password
            $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465; // TCP port to connect to

            //Recipients
            $mail->setFrom('frediustc@gmail.com', 'Batir SA');

            foreach ($clients as $client) {
                $mail->addAddress($client);
            }
            // $mail->addAddress('joe@example.net', 'Joe User'); // Add a recipient
            // $mail->addAddress('ellen@example.com'); // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
            $mail->addAttachment($img['tmp_name']); // Optional name

            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $sujet;
            $mail->Body = '<img src="' . $dest . '"alt="preview"/>This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = $corps;

            $mail->send();
            alert('success: Newsletter envoyee!', 'success');

        } catch (Exception $e) {
            alert('Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }

        // } else {
        //     alert('erreur: Image ajoute!');
        // }

    }

}
