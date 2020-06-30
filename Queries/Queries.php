<?php
    class Queries {
        // Login logic
        public function login(){
            include "../../Database/database_connectie.php";

            if (isset($_POST["login"])){
                // Filtreer input
                $gebruikersnaam = filter_input(INPUT_POST, "gebruikersnaam", FILTER_SANITIZE_STRING);
                $wachtwoord = filter_input(INPUT_POST, "wachtwoord", FILTER_SANITIZE_STRING);
                $adminGebruikersnaam = $this->getAdminGebruikersnaam();

                // Maak de query
                $query = $db->prepare("SELECT * FROM eigenaar 
                WHERE eigenaargebruikersnaam = :gebruikersnaam AND eigenaarwachtwoord = :wachtwoord");

                // Bind parameters
                $query->bindParam("gebruikersnaam", $gebruikersnaam);
                $query->bindParam("wachtwoord", $wachtwoord);

                // Voer de query uit
                $query->execute();
                
                // Check of de gebruikersnaam en wachtwoord overeenkomen met de database
                if ($query->rowCount() == 1){
                    if ($gebruikersnaam == $adminGebruikersnaam){
                        header("Location: ../Admin/admin_pagina.php");
                    } else {
                        // Header naar klanten scherm
                        echo "Klantieee!";
                    }
                } else {
                    echo "<p style='color: red'>Onjuiste inloggegevens!</p>";
                }
            }
        }

        public function createKlant() {
            include "../../Database/database_connectie.php";

            if (isset($_POST["voegtoe"])){
                // Filtreer
                $naam = filter_input(INPUT_POST, "naam", FILTER_SANITIZE_STRING);
                $gebruikersnaam = filter_input(INPUT_POST, "gebruikersnaam", FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $telnr = filter_input(INPUT_POST, "telnr", FILTER_SANITIZE_STRING);
                $adres = filter_input(INPUT_POST, "adres", FILTER_SANITIZE_STRING);
                $wachtwoord = sha1($_POST["wachtwoord"]);

                // Checkt of alle velde correct zijn ingevuld
                if (trim($naam) == "" || trim($gebruikersnaam) == "" || trim($email) == "" || trim($telnr) == "" || trim($adres) == "" || trim($wachtwoord) == ""){

                    echo "<p style='color: red'>Niet alle velden zijn ingevuld. Probeer het opnieuw!</p>";
                    
                } else {
                    // Maakte query om ingevoerde data in de database te zetten
                    $query = $db->prepare("INSERT INTO 
                    eigenaar(eigenaargebruikersnaam, eigenaarnaam, eigenaartel, eigenaarmail, eigenaarwoonplaats, eigenaarwachtwoord)
                    VALUES(:gebruikersnaam, :naam, :tel, :mail, :adres, :wachtwoord)");

                    // Bind de parameters
                    $query->bindParam("gebruikersnaam", $gebruikersnaam);
                    $query->bindParam("naam", $naam);
                    $query->bindParam("tel", $telnr);
                    $query->bindParam("mail", $email);
                    $query->bindParam("adres", $adres);
                    $query->bindParam("wachtwoord", $wachtwoord);

                    // Check of de query is uitgevoerd en voeg de data in de database
                    if ($query->execute()){
                        echo "<p style='color: green'>Met succes toegevoegd!</p>";
                    } else {
                        echo '<p style="color: red">Er is iets fouts gegaan</p>';
                    }
                }
            }
        }

        // Method om auto toe te voegen bij database bij behorende klant
        public function createAuto(){
            include "../../Database/database_connectie.php";

            if (isset($_POST["voegtoe"])){
                // Filtreer de input
                $kenteken = filter_input(INPUT_POST, "kenteken", FILTER_SANITIZE_STRING);
                $merk = filter_input(INPUT_POST, "merk", FILTER_SANITIZE_STRING);
                $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_STRING);
                $prijs = filter_input(INPUT_POST, "prijs", FILTER_SANITIZE_NUMBER_INT);
                
                // Maakt de query om de data in de database in te voeren
                $query = $db->prepare("INSERT INTO auto(autokenteken, automerk, autotype, autoprijs, eigenaarid)
                VALUES(:kenteken, :automerk, :autotype, :autoprijs, :id)");
        
                // Bind parameters
                $query->bindParam("kenteken", $kenteken);
                $query->bindParam("automerk", $merk);
                $query->bindParam("autotype", $type);
                $query->bindParam("autoprijs", $prijs);
                $query->bindParam("id", $_GET["id"]);
                
                // Checkt of alles is ingevuld
                if (trim($kenteken) == "" || trim($merk) == "" || trim($type) == "" || trim($prijs) == ""){
                    echo '<p style="color: red">Niet alle velden zijn ingevuld!</p>';
                } else {
                    // Checkt of de query met succes is uitgevoerd
                    if ($query->execute()){
                        echo '<p style="color: green">Met success toegevoegd!</p>';
                    } else {
                        // Er is iets fouts gegaan tijdens het uitvoeren van de query
                        echo '<p style="color: red">Er is iets fouts gegaan!</p>';
                    }
                }
            }
        }

        public function getAutoData(){
            include "../../Database/database_connectie.php";
            
            $id = $_GET["id"];
            
            // Maak query om alle gegevens uit te lezen
            $query = $db->prepare("SELECT * FROM auto WHERE eigenaarid = $id");
            
            // Voer query uit
            $query->execute();
    
            // Maak array van data
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            // Returnt array met data van database
            return $result;
        }

        // Update auto profiel
        public function updateAutoProfiel(){
            include "../../Database/database_connectie.php";
            
            $result = $this->getAutoData();
            $id = $_GET["id"];

            foreach($result as &$data){
                $automerk = $data["automerk"];
                $autotype = $data["autotype"];
                $autoprijs = $data["autoprijs"];

                // Output een formulier
                echo "<form method='post' autocomplete='off'>";
                    echo "<input type='text' name='merk' value='$automerk' /><br><br>";
                    echo "<input type='text' name='type' value='$autotype' /><br><br>";
                    echo "<input type='text' name='prijs' value='$autoprijs' /><br><br>";
                    echo "<input type='submit' name='update' value='Update' />";
                echo "</form>";
            }

            if (isset($_POST["update"])){
                // Filtreer input data
                $merk = filter_input(INPUT_POST, "merk", FILTER_SANITIZE_STRING);
                $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_STRING);
                $prijs = filter_input(INPUT_POST, "prijs", FILTER_SANITIZE_STRING);

                // Query om tabel te updaten met ingevoerde data
                $query = $db->prepare("UPDATE auto SET automerk = :merk, autotype = :type, autoprijs = :prijs WHERE eigenaarid = $id");
                
                // Bind parameters
                $query->bindParam("merk", $merk);
                $query->bindParam("type", $type);
                $query->bindParam("prijs", $prijs);

                if ($query->execute()){
                    header("Location: klant_auto_profiel.php?id=$id");
                } else {
                    echo '<p style="color: red">Er is iets fouts gegaan!</p>';
                }
            }

        }

        // Return alle klanten
        public function getKlanten(){
            include "../../Database/database_connectie.php";
            
            // Selecteer alle data van de eigenaar tabek
            $query = $db->prepare("SELECT * FROM eigenaar");

            // Voert de query uit
            $query->execute();

            // Maakt array met alle data erin
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            // Returnt array met geselecteerde data van database
            return $result; 
        }

        // Krijg Admin gebruikersnaam
        public function getKlantGebruikersnaam(){
            include "../../Database/database_connectie.php";

            // Maak query om gebruikersnaam te selecteren
            $query = $db->prepare("SELECT eigenaargebruikersnaam FROM eigenaar WHERE eigenaarid = :id");

            // Bind parameters
            $query->bindParam("id", $_GET["id"]);

            // Voer de query uit
            $query->execute();

            // Maak een array van de geselecteede data
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            // Returnt gebruikersnaam van Admin
            foreach ($result as &$data){
                return $data["eigenaargebruikersnaam"];
                break;
            }
        }

        // Krijg data van admin
        public function getKlantData(){
            include "../../Database/database_connectie.php";
            
            $gebruikersnaam = $this->getKlantGebruikersnaam();
            
            // Maak query om alle gegevens uit te lezen
            $query = $db->prepare("SELECT * FROM eigenaar WHERE eigenaargebruikersnaam = '".$gebruikersnaam."'");
            
            // Voer query uit
            $query->execute();
    
            // Maak array van data
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            // Returnt array met data van database
            return $result;
        }

        // Update klant profiel
        public function updateKlantProfiel(){
            include "../../Database/database_connectie.php";
            
            // Krijg de gebruikersnaam
            $id = $_GET["id"];

            // Maak query om alle gegevens uit te lezen
            $query = $db->prepare("SELECT * FROM eigenaar WHERE eigenaarid = $id");
        
            // Voer query uit
            $query->execute();
            
            // Maak array van data
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as &$data){
                $naam = $data["eigenaargebruikersnaam"];
                $tel = $data["eigenaartel"];
                $mail = $data["eigenaarmail"];
                $adres = $data["eigenaarwoonplaats"];

                // Output een formulier
                echo "<form method='post' autocomplete='off'>";
                    echo "<input type='text' name='gebruikersnaam' value='$naam' /><br><br>";
                    echo "<input type='text' name='telnr' value='$tel' /><br><br>";
                    echo "<input type='text' name='mail' value='$mail' /><br><br>";
                    echo "<input type='text' name='adres' value='$adres' /><br><br>";
                    echo "<input type='submit' name='update' value='Update' />";
                echo "</form>";
            }

            if (isset($_POST["update"])){
                // Filtreer input
                $gebruikersnaam = filter_input(INPUT_POST, "gebruikersnaam", FILTER_SANITIZE_STRING);
                $telnr = filter_input(INPUT_POST, "telnr", FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_STRING);
                $klantadres = filter_input(INPUT_POST, "adres", FILTER_SANITIZE_STRING);
                
                // Maak query om gegevens up te daten
                $query= $db->prepare("UPDATE eigenaar 
                SET eigenaargebruikersnaam = :gebruikersnaam, eigenaartel = :telnr, eigenaarmail = :email, eigenaarwoonplaats = :adres 
                WHERE eigenaarid = :id");
                
                // Bind de parameters
                $query->bindParam("gebruikersnaam", $gebruikersnaam);
                $query->bindParam("telnr", $telnr);
                $query->bindParam("email", $email);
                $query->bindParam("adres", $klantadres);
                $query->bindParam("id", $id);
                
                // Checkt of de query met success is uitgevoerd
                if ($query->execute()) {
                    header("Location: klant_profiel.php?id=$id");
                } else {
                    echo '<p style="color: red">Er is iets fouts gegaan!</p>';
                }
            }
        }

        // Method om alleen de gebruikersnaam uit de tabel te selecten
        public function getGebruikersnaam(){
            include "../../Database/database_connectie.php";

            // Maak query om gebruikersnaam te selecteren
            $query = $db->prepare("SELECT eigenaargebruikersnaam FROM eigenaar WHERE eigenaarid = :id");

            // Bind parameters
            $query->bindParam("id", $_GET["id"]);

            // Voer de query uit
            $query->execute();

            // Maak een array van de geselecteede data
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            // Returnt array met data van alle gebruikersnamen
            return $result;
        }

        // Krijg Admin gebruikersnaam
        public function getAdminGebruikersnaam(){
            include "../../Database/database_connectie.php";

            // Maak query om gebruikersnaam te selecteren
            $query = $db->prepare("SELECT eigenaargebruikersnaam FROM eigenaar");

            // Voer de query uit
            $query->execute();

            // Maak een array van de geselecteede data
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            // Returnt gebruikersnaam van Admin
            foreach ($result as &$data){
                return $data["eigenaargebruikersnaam"];
                break;
            }
        }

        // Krijg data van admin
        public function getAdminData(){
            include "../../Database/database_connectie.php";
            
            $gebruikersnaam = $this->getAdminGebruikersnaam();
            
            // Maak query om alle gegevens uit te lezen
            $query = $db->prepare("SELECT * FROM eigenaar WHERE eigenaargebruikersnaam = '".$gebruikersnaam."'");
    
            // Voer query uit
            $query->execute();
    
            // Maak array van data
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            // Returnt array met data van database
            return $result;
        }
        
        // Update admin profiel
        public function updateAdminProfiel(){
            include "../../Database/database_connectie.php";
            
            $naam = $this->getAdminGebruikersnaam();

            // Maak query om alle gegevens uit te lezen
            $query = $db->prepare("SELECT * FROM eigenaar WHERE eigenaargebruikersnaam = '".$naam."'");
        
            // Voer query uit
            $query->execute();
            
            // Maak array van data
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
            // Loopt door array
            foreach ($result as &$data){
                $tel = $data["eigenaartel"];
                $mail = $data["eigenaarmail"];
                
                // Output een formulier
                echo "<form method='post' autocomplete='off'>";
                    echo "<input type='text' name='gebruikersnaam' value='$naam' /><br><br>";
                    echo "<input type='text' name='telnr' value='$tel' /><br><br>";
                    echo "<input type='text' name='mail' value='$mail' /><br><br>";
                    echo "<input type='submit' name='update' value='Update' />";
                echo "</form>";
            }
            
            if (isset($_POST["update"])){
                // Filtreer input
                $gebruikersnaam = filter_input(INPUT_POST, "gebruikersnaam", FILTER_SANITIZE_STRING);
                $telnr = filter_input(INPUT_POST, "telnr", FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_STRING);
                
                // Maak query om gegevens up te daten
                $query= $db->prepare("UPDATE eigenaar 
                SET eigenaargebruikersnaam = :gebruikersnaam, eigenaartel = :telnr, eigenaarmail = :email WHERE eigenaarid = 1");
        
                // Bind de parameters
                $query->bindParam("gebruikersnaam", $gebruikersnaam);
                $query->bindParam("telnr", $telnr);
                $query->bindParam("email", $email);
        
                // Checkt of de query met success is uitgevoerd
                if ($query->execute()) {
                    header("Location: admin_profiel_pagina.php");
                } else {
                    echo '<p style="color: red">Er is iets fouts gegaan!</p>';
                }
            }
        }
    }