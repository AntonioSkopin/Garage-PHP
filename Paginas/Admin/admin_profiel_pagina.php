<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Styles/admin_profiel_pagina.css">
</head>
<body>
    <div class="container">
        <div class="container-content">
            <a class="back-bttn" href="admin_pagina.php">X</a>
            <div class="col1">
                <?php 
                    include "../../Queries/Queries.php";

                    // Instance of Queries
                    $query = new Queries();

                    // Bewaart de gereturnde waarde van de method in result
                    $result = $query->getAdminData();

                    // Loopt door array
                    foreach ($result as &$data){
                        echo "<p>" . $query->getAdminGebruikersnaam() . "</p><br>";
                        echo "<p>" . $data["eigenaartel"] . "</p><br>";
                        echo "<p>" . $data["eigenaarmail"] . "</p><br>";
                    } 
                ?>
            </div>
            <div class="col2">
                <h3>Admin Profiel</h3><br><br>
                <a class="bewerk-profiel-bttn" href="update_admin_profiel.php">Bewerk profiel</a>
            </div>
        </div>
    </div>
</body>
</html>