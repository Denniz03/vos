<!DOCTYPE html>
<html>
<head>
    <title>Voertuigen en Bedrijven</title>
    <style>
        .tab {
            display: none;
        }
    </style>
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "denniz03";
    $password = "gxd7Hv";
    $database = "vos";

    // Verbinding maken met de database
    $conn = new mysqli($servername, $username, $password, $database);

    // Controleren op fouten bij het maken van de verbinding
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query om te controleren of de voertuigen tabel bestaat
    $query = "SELECT 1 FROM `vos`.`voertuigen` LIMIT 1";
    $result = $conn->query($query);

    // Als de voertuigen tabel niet bestaat, maak deze dan aan
    if (!$result) {
        $createTableQuery = "CREATE TABLE `vos`.`voertuigen` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `kenteken` VARCHAR(50) NOT NULL,
            `merk` VARCHAR(50) NOT NULL,
            `model` VARCHAR(50) NOT NULL,
            `uitvoering` VARCHAR(50) NOT NULL,
            `brandstof` VARCHAR(50) NOT NULL,
            `kleur` VARCHAR(50) NOT NULL,
            `carrosserie` VARCHAR(50) NOT NULL,
            `bouwjaar` INT NOT NULL,
            `apk_datum` DATE NOT NULL,
            `aankoop_datum` DATE NOT NULL,
            `aankoop_kmstand` INT NOT NULL,
            `aankoop_bedrijf` VARCHAR(50) NOT NULL,
            `bandenmaat_voor` VARCHAR(50) NOT NULL,
            `bandenmaat_achter` VARCHAR(50) NOT NULL,
            `bandenspanning_voor` INT NOT NULL,
            `bandenspanning_achter` INT NOT NULL,
            `olie` VARCHAR(50) NOT NULL,
            `belasting_per_maand` DECIMAL(10,2) NOT NULL,
            `verzekering_per_maand` DECIMAL(10,2) NOT NULL,
            `verzekeringsmaatschappij` VARCHAR(50) NOT NULL,
            `verzekerings_type` VARCHAR(50) NOT NULL,
            `polisnummer` VARCHAR(50) NOT NULL,
            `energielabel` VARCHAR(50) NOT NULL,
            `emissieklasse` VARCHAR(50) NOT NULL,
            PRIMARY KEY (`id`)
        )";
        $conn->query($createTableQuery);
    }

    // Query om te controleren of de bedrijven tabel bestaat
    $query = "SELECT 1 FROM `vos`.`bedrijven` LIMIT 1";
    $result = $conn->query($query);

    // Als de bedrijven tabel niet bestaat, maak deze dan aan
    if (!$result) {
        $createTableQuery = "CREATE TABLE `vos`.`bedrijven` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `naam` VARCHAR(50) NOT NULL,
            `adres` VARCHAR(100) NOT NULL,
            `telefoon` VARCHAR(20) NOT NULL,
            PRIMARY KEY (`id`)
        )";
        $conn->query($createTableQuery);
    }

    $conn->close();
    ?>

    <div>
        <button class="tablink" onclick="openTab(event, 'voertuigen')">Voertuigen</button>
        <button class="tablink" onclick="openTab(event, 'bedrijven')">Bedrijven</button>
    </div>

    <div id="voertuigen" class="tab">
        <h2>Voertuigen</h2>
        <table>
            <tr>
                <th>Kenteken</th>
                <th>Merk</th>
                <th>Model</th>
                <!-- Voeg hier andere kolommen toe -->
            </tr>
            <?php
            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Controleren of de tabel "voertuigen" bestaat
            $checkTableQuery = "SHOW TABLES LIKE 'voertuigen'";
            $checkTableResult = $conn->query($checkTableQuery);
            if ($checkTableResult->num_rows === 0) {
                // Tabel bestaat niet, voer hier eventueel code uit om de tabel aan te maken
                echo "<tr><td colspan='3'>De tabel 'voertuigen' bestaat niet.</td></tr>";
            } else {
                $sql = "SELECT * FROM voertuigen";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><a href='view.php?id=" . $row['id'] . "'>" . $row['kenteken'] . "</a></td>";
                        echo "<td>" . $row['merk'] . "</td>";
                        echo "<td>" . $row['model'] . "</td>";
                        // Voeg hier andere kolommen toe
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Geen voertuigen gevonden</td></tr>";
                }
            }

            $conn->close();
            ?>
        </table>

        <button onclick="window.location.href='add_vehicle.php'">Voertuig toevoegen</button>
    </div>

    <div id="bedrijven" class="tab">
        <h2>Bedrijven</h2>
        <table>
            <tr>
                <th>Naam</th>
                <th>Adres</th>
                <th>Telefoon</th>
                <!-- Voeg hier andere kolommen toe -->
            </tr>
            <?php
            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Controleren of de tabel "bedrijven" bestaat
            $checkTableQuery = "SHOW TABLES LIKE 'bedrijven'";
            $checkTableResult = $conn->query($checkTableQuery);
            if ($checkTableResult->num_rows === 0) {
                // Tabel bestaat niet, voer hier eventueel code uit om de tabel aan te maken
                echo "<tr><td colspan='3'>De tabel 'bedrijven' bestaat niet.</td></tr>";
            } else {
                $sql = "SELECT * FROM bedrijven";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><a href='view.php?id=" . $row['id'] . "'>" . $row['naam'] . "</a></td>";
                        echo "<td>" . $row['adres'] . "</td>";
                        echo "<td>" . $row['telefoon'] . "</td>";
                        // Voeg hier andere kolommen toe
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Geen bedrijven gevonden</td></tr>";
                }
            }

            $conn->close();
            ?>
        </table>

        <button onclick="window.location.href='add_company.php'">Bedrijf toevoegen</button>
    </div>
</body>
</html>
