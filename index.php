<?php
    include 'functions.php';    

    $voertuigenList= array("carrosserie", "kenteken", "merk", "model", "uitvoering");
    $bedrijvenList = array("naam", "straat", "huisnummer", "postcode", "plaats", "telefoon");

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

    // Haal sorteer waarde op
    $sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';
    $tab = isset($_GET['tab']) ? $_GET['tab'] : 'voertuigen';
    if ($tab == 'voertuigen') {
        $skipFirst = true;
        $list = $voertuigenList;
    } else {
        $list = $bedrijvenList;
    }
    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
    } else {
        if ($tab == 'voertuigen') {
            $sort = 'RIGHT(aankoop_datum, 4)';
            $sortOrder = 'desc';
        } else {
            $sort = '"naam"';
            $sortOrder = 'desc';
        }
    }
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
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="java/java.js"></script>
</head>
<body>
    <header>
        <img src="images/logo.png" alt="Logo" class="logo">
        <div class="title-subtitle">
            <h1 class="title">VOS</h1>
            <h4 class="subtitle">Voertuig Onderhoud Systeem</h4>
        </div>
        <nav>
            <!-- Navigatiemenu -->
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Over</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <div id="tabs">
        <button class="tab-button" data-tab="voertuigen" onclick="location.href='?tab=voertuigen'">Voertuigen</button>
        <button class="tab-button" data-tab="bedrijven" onclick="location.href='?tab=bedrijven'">Bedrijven</button>
    </div>

    <!-- main -->
    <main>
        <section>
            <!-- voertuigen en bedrijven -->
            <div id="<?php echo $tab ?>" class="tab-content">
                <h2><?php echo $tab ?></h2>
                <div class="table-toolbar">
                    <button onclick="window.location.href='add.php?tab=<?php echo $tab ?>'"><p>Toevoegen</p><i class="fas fa-plus"></i></button>
                    <button onclick="editSelectedRow()"><p>Bewerken</p><i class="fas fa-edit"></i></button>
                    <button onclick="deleteSelectedRow()"><p>Verwijderen</p><i class="fas fa-remove"></i></button>
                </div>
                <table class="list">
                    <!-- tabel headers -->
                    <tr>
                        <?php
                            foreach ($list as $tbl_header) {
                                if ($tab == 'voertuigen' && $skipFirst == true) {
                                    echo '<th class="' . ($sort === $tbl_header ? 'sort' : '') . '" onclick="location.href=\'?tab=' . $tab . '&sort=' . ($sortOrder !== 'desc' ? $tbl_header . '&order=desc' : $tbl_header) . '\'">Soort<i class="fas fa-sort"></i></th>';
                                    $skipFirst = false;
                                    continue;
                                }
                                echo '<th class="' . ($sort === $tbl_header ? 'sort' : '') . '" onclick="location.href=\'?tab=' . $tab . '&sort=' . ($sortOrder !== 'desc' ? $tbl_header . '&order=desc' : $tbl_header) . '\'">' . $tbl_header . '<i class="fas fa-sort"></i></th>';
                            }
                        ?>
                    </tr>
                    <!-- tabel content -->
                    <?php
                    $checkTableQuery = "SHOW TABLES LIKE '$tab'";
                    $checkTableResult = $conn->query($checkTableQuery);
                    if ($checkTableResult->num_rows === 0) {
                        echo "<tr><td colspan='5'>De tabel " . $tab . " bestaat niet.</td></tr>";
                    } else {
                        $sql = "SELECT * FROM $tab ORDER BY $sort $sortOrder";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr onclick='selectRow(this, " . $row['id'] . ", \"" . $tab . "\")'>";
                                if ($tab == 'voertuigen') {
                                    $skipFirst = true;
                                }
                                foreach ($list as $tbl_header) {
                                    if ($tab == 'voertuigen' && $skipFirst == true) {
                                        echo "<td><i class='" . $carrosserieIconen[$row['carrosserie']] . "'></i></td>";
                                        $skipFirst = false;
                                        continue;
                                    }
                                    echo "<td>" . $row[$tbl_header] . "</td>";
                                }
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Geen " . $tab . " gevonden</td></tr>";
                        }
                    }
                    ?>
                </table>
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
            
        </section>
    </main>

    <!-- footer -->
    <footer>
        <section>
            <!-- Voettekst van de pagina -->
            <p class="copyright">&copy; Copyright <?php echo "2003-" . date("Y") } ?> <a href="https://denniz03.nl" target="_blank">Denniz03</a>. Alle rechten voorbehouden.</p>
        </section>
    </footer>
    
    <!-- Error / Success -->
    <script>
        <?php if (isset($_SESSION['alert'])) { ?>
            <?php $alert = explode(';', $_SESSION['alert']); ?>
            alertPopup('<?= $alert[0] ?>','<?= $alert[0] ?>','<?= $alert[1] ?>');
        <?php } ?>
    </script>

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
