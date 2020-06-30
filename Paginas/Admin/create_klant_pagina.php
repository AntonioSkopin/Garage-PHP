<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg klant toe</title>
    <link rel="stylesheet" href="../../Styles/voeg_klant.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="main-content">
            <a href="admin_pagina.php">X</a>
            <h1>Voeg een klant toe:</h1>
            <form method="post" autocomplete="off">
                <div class="container">
                    <div class="col1">
                        <input type="text" name="naam" placeholder="Volledige naam:">
                        <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam:">
                        <input type="text" name="email" placeholder="E-mail adres:">
                    </div>
                    <div class="col2">
                        <input type="text" name="telnr" placeholder="Telefoon nummer:">
                        <input type="text" name="adres" placeholder="Adres:">
                        <input type="password" name="wachtwoord" placeholder="Wachtwoord:">
                    </div>
                </div>
                <input type="submit" name="voegtoe" value="VOEG TOE">
                <?php
                    include "../../Queries/Queries.php";

                    $query = new Queries();
                    $query->createKlant();
                ?>
            </form>
        </div>
    </main>
</body>
</html>