<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin Profiel</title>
    <link rel="stylesheet" href="../../Styles/update-profiel.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="container-content">
            <h1>Bewerk profiel</h1><br><br>
            <a class="back-bttn" href="admin_profiel_pagina.php">X</a>
            <?php
                include "../../Queries/Queries.php";
                
                $query = new Queries();
                $query->updateAdminProfiel();
            ?>
        </div>
    </div>
</body>
</html>