<?php 
session_start();
include 'header.php'; 
?>

<h2>Contact Us</h2>

<p>We'd love to hear from you! You can reach us through the following:</p>

<?php
    $file = fopen("contacts.txt", "r");
    while (!feof($file)) {
        echo fgets($file) . "<br>";
    }
    fclose($file);
?>

<?php include 'footer.php'; ?>