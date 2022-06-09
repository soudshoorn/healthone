<?php 
    try {
        $db = new PDO("mysql:host=localhost;dbname=healthone", "root", "root");

    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }
?>