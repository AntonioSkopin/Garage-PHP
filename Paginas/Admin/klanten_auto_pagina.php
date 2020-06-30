<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klanten</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Styles/klanten.css">
</head>
<body>
    <main>
        <div class="main-content">
        <a class="back-bttn" href="admin_pagina.php">X</a>
            <h2>Selecteer de klant waar de auto aan toegevoegd word:</h2>
            <div class="klanten">
            <?php
                include "../../Queries/Queries.php";
                
                $query = new Queries();

                // Bewaart de gereturnde waarde van de method in result
                $result = $query->getKlanten();

                // Houdt de Admin gebruikersnaam
                $gebruikersnaam = $query->getAdminGebruikersnaam();

                // Loopt door array
                foreach ($result as &$data){
                    if ($data["eigenaargebruikersnaam"] == $gebruikersnaam){
                        continue;
                    } else {
                        echo "<br><a class='eigenaar' href='insert_auto_pagina.php?id=" . $data['eigenaarid'] . "'>" . $data["eigenaarnaam"] . "</a><br><br>";
                    }
                }
            ?>
            </div>
        </div>
    </main>
</body>
</html>