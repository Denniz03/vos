<!DOCTYPE html>
<html>
<head>
    <title>Voertuigen en Bedrijven</title>
    <style>
        /* Tabbladstijl voor knoppen */
        .tab-button {
            background-color: #f1f1f1;
            border: none;
            color: black;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .tab-button.active {
            background-color: #ccc;
        }

        /* Tabbladstijl voor inhoud */
        .tab-content {
            display: none;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
        }

        /* Toon het actieve tabblad */
        .tab-content.active {
            display: block;
        }

        .tab {
            display: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Functie om een tabblad te openen
            function openTab(tabName) {
                var tabcontent = $(".tab-content");
                var tablinks = $(".tab-button");
                tabcontent.removeClass("active");
                tablinks.removeClass("active");
                $("#" + tabName).addClass("active");
                $("button[data-tab='" + tabName + "']").addClass("active");
            }

            // Eventlistener voor het klikken op een tabknop
            $(".tab-button").click(function() {
                var tabName = $(this).data("tab");
                openTab(tabName);
            });

            // Functie om de tabbladpagina te openen op basis van de URL-parameter
            function openTabFromURL() {
                var urlParams = new URLSearchParams(window.location.search);
                var tabName = urlParams.get("tab");
                if (tabName) {
                    openTab(tabName);
                } else {
                    openTab("voertuigen"); // Standaard tabblad
                }
            }

            // Open het juiste tabblad bij het laden van de pagina
            openTabFromURL();
        });
    </script>
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "denniz03";
        $password = "gxd7Hv";
        $database = "vos";
    ?>

    <div>
        <button class="tab-button" data-tab="voertuigen">Voertuigen</button>
        <button class="tab-button" data-tab="bedrijven">Bedrijven</button>
    </div>

    <div id="voertuigen" class="tab-content">
        <h2>Voertuigen</h2>
        <table>
            <tr>
            <th><a href="?tab=voertuigen&sort=kenteken">Kenteken</a></th>
                <th><a href="?tab=voertuigen&sort=merk">Merk</a></th>
                <th><a href="?tab=voertuigen&sort=model">Model</a></th>
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

    <div id="bedrijven" class="tab-content">
        <h2>Bedrijven</h2>
        <table>
            <tr>
                <th><a href="?tab=bedrijven&sort=naam">Naam</a></th>
                <th><a href="?tab=bedrijven&sort=adres">Adres</a></th>
                <th><a href="?tab=bedrijven&sort=telefoon">Telefoon</a></th>
                <!-- Add other columns here -->
            </tr>
            <?php
            $conn = new mysqli($servername, $username, $password, $database);
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
                        echo "<tr>";
                        echo "<td><a href='view.php?id=" . $row['id'] . "'>" . $row['naam'] . "</a></td>";
                        echo "<td>" . $row['adres'] . "</td>";
                        echo "<td>" . $row['telefoon'] . "</td>";
                        // Add other columns here
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No companies found.</td></tr>";
                }
            }

            $conn->close();
            ?>
        </table>

        <button onclick="window.location.href='add_company.php'">Bedrijf toevoegen</button>
    </div>
</body>
</html>
