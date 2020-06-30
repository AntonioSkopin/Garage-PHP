<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=garage", "root", "");
    } catch (PDOException $e){
        die("Error: " . $e->getMessage());
    }