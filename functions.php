<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('log_errors', 1);

    header("Cache-Control: no-cache, must-revalidate");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['edit_id'])) {
            $_SESSION['selected_id'] = $_POST['edit_id'];
            // Voer hier eventuele andere bewerkingen uit
        } elseif (isset($_POST['delete_id'])) {
            $_SESSION['selected_id'] = $_POST['delete_id'];
            // Voer hier eventuele andere verwijderingsacties uit
        }
    }

    // Functie om verbinding met de database te maken
    function connectToDatabase() {
        // Databasegegevens
        $servername = "localhost";
        $username = "denniz03";
        $password = "gxd7Hv";
        $database = "vos";
        
        // Maak een nieuwe mysqli-object voor de databaseverbinding
        $conn = new mysqli($servername, $username, $password, $database);

        // Controleer of er een fout is opgetreden tijdens de verbinding
        if ($conn->connect_error) {
            // Toon een foutmelding en geef false terug
            die("Connection failed: " . $conn->connect_error);
            return false;
        }

        // Geef de mysqli-object terug
        return $conn;
    }
    $conn = connectToDatabase();

    // Functie om de database verbinding te verbreken
    function disconnectFromDatabase($conn) {
        $conn->close();
    }

    // Functie voor het valideren van invoer
    function validateInput($input) {
        // Verwijderen van ongewenste spaties aan het begin en einde
        $input = trim($input);
        // Verwijderen van slashes
        $input = stripslashes($input);
        // Escapen van speciale tekens
        $input = htmlspecialchars($input);
        return $input;
    }

    // Functie voor het verwerken van de $_POST-array en valideren van de invoerwaarden
    function processPostData() {
        // Itereer over elke sleutel-waardepaar in $_POST
        foreach ($_POST as $key => $value) {
            // Wijs de waarde toe aan $_POST
            $_POST[$key] = $value;

            // Valideer de invoerwaarde met de functie 'validateInput'
            global ${$key};
            if ($key == 'kenteken') {
                ${$key} = validateInput(strtoupper($value));
            } else {
                ${$key} = validateInput($value);
            }

            // Toon de sleutel en waarde in de browser
            echo $key . '=' . $value . '<br>';
        }

        // Voeg een lege regel toe aan de uitvoer
        echo '<br>';
    }

    // Function te get companys
    function getCompanys() {
        $conn = connectToDatabase();
        
        // Query uitvoeren om gegevens op te halen
        $sql = "SELECT * FROM bedrijven";
        $result = $conn->query($sql);

        $bedrijven = array();

        // Controleren of er rijen zijn gevonden
        if ($result->num_rows > 0) {
            // Rijen ophalen en in de array opslaan
            while ($row = $result->fetch_assoc()) {
                $bedrijven[$row['id']] = $row['naam'];
            }
        }
        // Verbreek de verbinding met de database
        disconnectFromDatabase($conn);
        return $bedrijven;

    }

    // Functie om voertuigen uit de database op te halen
    function getVehicles() {
        $conn = connectToDatabase();

        // Query uitvoeren om gegevens op te halen
        $sql = "SELECT * FROM voertuigen";
        $result = $conn->query($sql);

        $voertuigen = array();

        // Controleren of er rijen zijn gevonden
        if ($result->num_rows > 0) {
            // Rijen ophalen en in de array opslaan
            while ($row = $result->fetch_assoc()) {
                $voertuigen[$row['id']] = $row['merk'] . ' ' . $row['model'];
            }
        }
        // Verbreek de verbinding met de database
        disconnectFromDatabase($conn);
        return $voertuigen;
    }

?>