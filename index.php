<?php
    include 'functions.php';    

    // Array met carrosseriegroepen en bijbehorende icoonklassen
    $carrosserieIconen = array(
        "Bestelbus" => "fas fa-shuttle-van",
        "Cabriolet" => "fas fa-car-side",
        "Coupé" => "fas fa-car-side",
        "Hatchback" => "fas fa-car-side",
        "MPV" => "fas fa-car-side",
        "Motorfiets" => "fas fa-motorcycle",
        "Scooter" => "fas fa-scooter",
        "Sedan" => "fas fa-car-side",
        "Stationwagen" => "fas fa-car-side",
        "SUV" => "fas fa-shuttle-van"
    );

    $sortField = isset($_GET['sort']) ? $_GET['sort'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Voertuigen en Bedrijven</title>
    <meta charset="utf-8">
    <meta name="robots" content="none">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="images/logo.png">    <meta name="format-detection" content="telephone=yes">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="java.js"></script>
</head>
<body>
    <header>
        <img src="images/logo.png" alt="Logo" class="logo">
        <div class="title-subtitle">
            <h1 class="title">VOS</h1>
            <h4 class="subtitle">Voertuig Onderhoud Systeem</h4>
        </div>
    </header>
    <div id="tabs">
        <button class="tab-button" data-tab="voertuigen" onclick="location.href='?tab=voertuigen'">Voertuigen</button>
        <button class="tab-button" data-tab="bedrijven" onclick="location.href='?tab=bedrijven'">Bedrijven</button>
    </div>

    <!-- voertuigen -->
    <div id="voertuigen" class="tab-content">
        <h2>Voertuigen</h2>
        <div class="table-toolbar">
            <button onclick="window.location.href='add_vehicle.php'"><p>Toevoegen</p><i class="fas fa-plus"></i></button>
            <button onclick="editSelectedRow()"><p>Bewerken</p><i class="fas fa-edit"></i></button>
            <button onclick="deleteSelectedRow()"><p>Verwijderen</p><i class="fas fa-remove"></i></button>
        </div>
        <table class="list">
            <tr>
            <th class="<?php echo $sortField === 'carrosserie' ? 'sort' : ''; ?>" onclick="location.href='?tab=voertuigen&sort=carrosserie'">soort<i class="fas fa-sort"></i></th>
            <th class="<?php echo $sortField === 'kenteken' ? 'sort' : ''; ?>" onclick="location.href='?tab=voertuigen&sort=kenteken'">Kenteken<i class="fas fa-sort"></i></th>
            <th class="<?php echo $sortField === 'merk' ? 'sort' : ''; ?>" onclick="location.href='?tab=voertuigen&sort=merk'">Merk<i class="fas fa-sort"></i></th>
            <th class="<?php echo $sortField === 'model' ? 'sort' : ''; ?>" onclick="location.href='?tab=voertuigen&sort=model'">Model<i class="fas fa-sort"></i></th>
            <th class="<?php echo $sortField === 'uitvoering' ? 'sort' : ''; ?>" onclick="location.href='?tab=voertuigen&sort=uitvoering'">uitvoering<i class="fas fa-sort"></i></th>
            </tr>
            <?php

            // Controleren of de tabel "voertuigen" bestaat
            $checkTableQuery = "SHOW TABLES LIKE 'voertuigen'";
            $checkTableResult = $conn->query($checkTableQuery);
            if ($checkTableResult->num_rows === 0) {
                // Tabel bestaat niet, voer hier eventueel code uit om de tabel aan te maken
                echo "<tr><td colspan='4'>De tabel 'voertuigen' bestaat niet.</td></tr>";
            } else {
                $sql = "SELECT * FROM voertuigen";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr onclick='selectRow(this, " . $row['id'] . ", \"voertuigen\")'>";
                        // De waarde van $row['carrosserie']
                        $carrosserie = $row['carrosserie'];

                        // Controleer of $carrosserie een bijpassend icoon heeft
                        if (array_key_exists($carrosserie, $carrosserieIconen)) {
                            $icoonKlasse = $carrosserieIconen[$carrosserie];
                        } else {
                            // Geef een standaardicoon weer als er geen bijpassend icoon is gevonden
                            $icoonKlasse = "fas fa-question";
                        }
                        echo "<td><i class='" . $icoonKlasse . "'></i></td>";
                        echo "<td>" . $row['kenteken'] . "</td>";
                        echo "<td>" . $row['merk'] . "</td>";
                        echo "<td>" . $row['model'] . "</td>";
                        echo "<td>" . $row['uitvoering'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Geen voertuigen gevonden</td></tr>";
                }
            }
            ?>
        </table>
    </div>

    <!-- bedrijven -->
    <div id="bedrijven" class="tab-content">
        <h2>Bedrijven</h2>
        <div class="table-toolbar">
            <button onclick="window.location.href='add_company.php'"><p>Toevoegen</p><i class="fas fa-plus"></i></button>
            <button onclick="editSelectedRow()"><p>Bewerken</p><i class="fas fa-edit"></i></button>
            <button onclick="deleteSelectedRow()"><p>Verwijderen</p><i class="fas fa-remove"></i></button>
        </div>
        <table class="list">
            <tr>
                <th onclick="location.href='?tab=bedrijven&sort=naam'">Naam<i class="fas fa-sort"></i></th>
                <th onclick="location.href='?tab=bedrijven&sort=adres'">Adres<i class="fas fa-sort"></i></th>
                <th onclick="location.href='?tab=bedrijven&sort=telefoon'">Telefoon<i class="fas fa-sort"></i></th>
            </tr>
            <?php
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if the "bedrijven" table exists
            $checkTableQuery = "SHOW TABLES LIKE 'bedrijven'";
            $checkTableResult = $conn->query($checkTableQuery);
            if ($checkTableResult->num_rows === 0) {
                // Table does not exist, you can add code here to create the table if needed
                echo "<tr><td colspan='3'>The 'bedrijven' table does not exist.</td></tr>";
            } else {
                $sort = isset($_GET['sort']) ? $_GET['sort'] : 'naam';
                $sql = "SELECT * FROM bedrijven ORDER BY $sort";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr onclick='selectRow(this, " . $row['id'] . ", \"bedrijven\")'>";
                        echo "<td>" . $row['naam'] . "</td>";
                        echo "<td>" . $row['adres'] . "</td>";
                        echo "<td>" . $row['telefoon'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No companies found.</td></tr>";
                }
            }
            ?>
        </table>
        <button onclick="window.location.href='add_company.php'">Bedrijf toevoegen</button>
    </div>

    <!-- details -->
    <h2>Details</h2>
    <div id="voertuigen-tabs">
        <button class="tab-button" data-tab="voertuig">Voertuig</button>
        <button class="tab-button" data-tab="techniek">Techniek</button>
        <button class="tab-button" data-tab="aankoop">Aankoop</button>
        <button class="tab-button" data-tab="verzekering">Verzekering</button>
        <button class="tab-button" data-tab="tankinformatie">tankinformatie</button>
        <button class="tab-button" data-tab="onderhoud">onderhoud</button>
    </div>
    <div id="content" class="tab-content">
        <!-- Hier wordt de inhoud van view.php weergegeven -->
    </div>

    <script>
        function loadContent(url, tabName) {
            $("#content").load(url);
            $("#content").show();
            if (tabName == "voertuigen") {
                $("#voertuigen-tabs").show();
                $("button[data-tab='voertuig']").addClass("active");
            } else {
                $("#voertuigen-tabs").hide();
            }
        }

        var selectedRow = null;

        function selectRow(row, id, tabName) {
            if (selectedRow !== null) {
                selectedRow.classList.remove("selected");
            }
            row.classList.add("selected");
            selectedRow = row;
            if (tabName == "voertuigen" || tabName == "bedrijven") {
                loadContent("view.php?tab=" + tabName + "&id=" + id, tabName);
            }
        }

        function editSelectedRow() {
            var selectedRow = document.querySelector('.list tr.selected');
            if (selectedRow) {
                // Voer hier de code uit om de geselecteerde rij te bewerken
                console.log("Bewerk de geselecteerde rij");
            } else {
                console.log("Geen rij geselecteerd");
            }
        }

        function deleteSelectedRow() {
            var selectedRow = document.querySelector('.list tr.selected');
            if (selectedRow) {
                // Voer hier de code uit om de geselecteerde rij te verwijderen
                console.log("Verwijder de geselecteerde rij");
            } else {
                console.log("Geen rij geselecteerd");
            }
        }
    </script>
    <?php
        disconnectFromDatabase($conn);
    ?>
</body>
</html>
