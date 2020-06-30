<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../Styles/loginpagina.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="main-container">
            <h1>LOGIN</h1>
            <form method="post" autocomplete="off">
                <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam:" />
                <br><br>
                <input type="password" name="wachtwoord" placeholder="Wachtwoord:" />
                <br><br><br>
                <input class="login" type="submit" name="login" value="LOGIN">
                <br><br>
            </form>
            <?php
                include "../../Queries/Queries.php";

                $query = new Queries();
                $query->login();
            ?>
        </div>
    </main>
</body>
</html>