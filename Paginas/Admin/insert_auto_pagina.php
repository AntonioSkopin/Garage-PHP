<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg auto toe</title>
    <link rel="stylesheet" href="../../Styles/create_auto.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" 
    rel="stylesheet">
</head>
<body>
    <main>
        <div class="main-content">
            <a href="klanten_auto_pagina.php">X</a>
            <h1>Voeg een auto toe:</h1>
            <form method="post" autocomplete="off">
                <div class="container">
                    <div class="col1">
                        <input type="text" name="kenteken" placeholder="Kenteken:">
                        <input type="text" name="merk" placeholder="Merk:">
                    </div>
                    <div class="col2">
                        <input type="text" name="type" placeholder="Type:">
                        <input type="text" name="prijs" placeholder="Prijs:">
                    </div>
                </div>
                <input type="submit" name="voegtoe" value="VOEG TOE">
                <?php
                    include "../../Queries/Queries.php";

                    $query = new Queries();
                    $query->createAuto();
                ?>
            </form>
        </div>
    </main>
</body>
</html>