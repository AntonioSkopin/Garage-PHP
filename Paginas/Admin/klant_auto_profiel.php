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
                include_once("../../Queries/Queries.php");

                // Instance of Queries
                $query = new Queries();

                // Bewaart de gereturnde waarde van de method in result
                $result = $query->getAutoData();
                
                // Loopt door array
                foreach ($result as &$data){
                    echo "<br>";
                    echo "<p>Kenteken: " . $data["autokenteken"] . "</p><br>";
                    echo "<p>Merk: " . $data["automerk"] . "</p><br>";
                    echo "<p>Type: " . $data["autotype"] . "</p><br>";
                    echo "<p>Prijs: &euro;" . $data["autoprijs"] . "</p><br>";
                }
            ?>
            </div>
            <div class="col2">
                <h3>Auto Profiel</h3><br><br>
                <?php
                    include_once("../../Queries/Queries.php");

                    $query = new Queries();

                    $id = $_GET["id"];
                    
                    echo "<br><a class='eigenaar' href='update_klantauto_profiel.php?id=" . $id . "'>Update</a><br><br>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>