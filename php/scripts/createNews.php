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
    $imgNbr = 0;

    if (isset($_FILES) && !empty($_FILES)) {
        $imgNbr = count($img['name']);

        // file check
        $target_dir = $ind . "assets/images/";
        for ($i = 0; $i < $imgNbr; $i++) {

            $target_file = $target_dir . basename($img["name"][$i]);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            // $check = getimagesize($img["tmp_name"][$i]);
            // if ($check == false) {
            //     $ok = false;
            //     alert('Fichier n\'est pas une image - ' . $check["mime"][$i] . '.');
            // }
            // Check if file already exists
            // if (file_exists($target_file)) {
            //     // $ok = false;
            //     echo "Sorry, file already exists.";
            // }
            // Check file size
            if ($img["size"][$i] > 4194304) {
                $ok = false;
                alert('Desole l\'image est trop lourde elle doit etre moins de 4Mo');
            }
            // Allow certain file formats
            // if (strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg") {
            //     $ok = false;
            //     alert('Desole le fichier n\'est pas une image (JPG, JPEG, PNG)');
            // }
        }

    } else {
        alert('Fichier: Aucun Fichier Ajoutee');
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
        $imgs = [];
        for ($i = 0; $i < $imgNbr; $i++) {
            $date = new DateTime();

            $n = 'Article_' . $date->getTimestamp() . '_' . $i . '.jpg';
            $dest = $target_dir . $n;
            array_push($imgs, $dest);
            move_uploaded_file($img["tmp_name"][$i], $dest);
        }

        //send the email
        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        try {
            //Server settings
            // $mail->SMTPDebug = 1; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->Username = 'frediustc@gmail.com'; // SMTP username
            $mail->Password = 'resurection'; // SMTP password
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('frediustc@gmail.com', 'Batir SA');

            foreach ($clients as $client) {
                $mail->addAddress($client);
            }

            //Attachments
            foreach ($imgs as $att) {
                $mail->addAttachment($att); // attachement
            }

            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $sujet;

            include $ind . 'php/scripts/generate.php';
            $mail->Body = generate($sujet, $desc, $corps);
            $mail->AltBody = strip_tags(generate($sujet, $desc, $corps));

            $mail->send();
            alert('success: Newsletter envoyee!', 'success');

        } catch (Exception $e) {
            alert('Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }
    }
}
