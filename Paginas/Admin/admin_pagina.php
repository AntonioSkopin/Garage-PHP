<?php
    // Checkt of de pagina in de url word gezocht
    if(!isset($_SERVER['HTTP_REFERER'])){
        // Als het in url word gezocht stuur ze terug naar startpagina
        header('Location: ../start_pagina.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin paneel</title>
    <link rel="stylesheet" href="../../Styles/adminpagina.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="main-content">
            <h2>Admin paneel</h2>
            <div class="container">
                <div class="container1">
                    <a href="alle_klanten_pagina.php">Alle klanten</a>
                    <a href="../verwijder_klant_pagina.php">Verwijder klant</a>
                </div>
                <div class="container2">
                    <a href="admin_profiel_pagina.php"><img src="../../Fotos/gebruiker-ic.png" alt="gebruiker icon"></a>
                </div>
                <div class="container3">
                    <a href="klanten_auto_pagina.php">Voeg auto toe</a>
                    <a href="create_klant_pagina.php">Voeg klant toe</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>