<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Styles/klant-profiel.css">
</head>
<body>
    <div class="container">
        <div class="container-content">
            <a class="back-bttn" href="alle_klanten_pagina.php">X</a>
            <div class="col1">
            <?php
                include "../../Queries/Queries.php";

                // Instance of Queries
                $query = new Queries();

                // Bewaart de gereturnde waarde van de method in result
                $result = $query->getKlantData();

                // Loopt door array
                foreach ($result as &$data){
                    echo "<br>";
                    echo "<p>" . $query->getKlantGebruikersnaam() . "</p><br>";
                    echo "<p>" . $data["eigenaartel"] . "</p><br>";
                    echo "<p>" . $data["eigenaarmail"] . "</p><br>";
                    echo "<p>" . $data["eigenaarwoonplaats"] . "</p><br>";
                }

            ?>
            </div>
            <div class="col2">
                <h3>Profiel</h3><br><br>
                <?php
                    // Get id from the url
                    $id = $_GET["id"];
                    echo "<br><a class='eigenaar' href='update_klant_profiel.php?id=" . $id . "'>Update</a><br><br>";
                    echo "<br><a class='eigenaar' href='klant_auto_profiel.php?id=" . $id . "'>Auto</a><br><br>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>