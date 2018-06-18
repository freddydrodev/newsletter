<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=newsletter', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
session_start();
