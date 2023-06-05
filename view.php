<?php
    include 'functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <script>
            $(document).ready(function() {
                $(".details").hide();
                $("#voertuig").show();
                <?php
                    if (isset($_GET['tab']) && $_GET['tab'] === 'bedrijven') {
                        echo "$('#voertuig').hide();";
                        echo "$('#bedrijf').show();";
                    }
                ?>
            });
        </script>
    </head>
    <body>
        <?php
            $id = $_GET['id'];

            if (isset($_GET['tab']) && $_GET['tab'] === 'bedrijven') {
                $sql = "SELECT * FROM bedrijven WHERE id = $id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $fields = [
                            'bedrijf' => [
                                'naam',
                                'adres',
                                'telefoon'
                            ]
                        ];

                        foreach ($fields as $group => $groupFields) {
                            echo "<div id='$group' class='details'>";
                            echo "<h2>$group</h2>";
                            echo "<table class='list'>";
                            echo "<tr hidden><td colspan='2'><strong>$group</strong></td></tr>";
                            foreach ($groupFields as $field) {
                                $value = $row[str_replace(" ", "_", $field)];
                                $field = str_replace("_", " ", $field);
                                echo "<tr>";
                                echo "<td>" . $field . "</td>";
                                echo "<td>" . $value . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
                        }
                    }
                } else {
                    echo "Bedrijf niet gevonden";
                }
            } else {
                // Laad voertuig informatie
                $sql = "SELECT * FROM voertuigen WHERE id = $id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $fields = [
                            'voertuig' => [
                                'kenteken',
                                'merk',
                                'model',
                                'uitvoering',
                                'brandstof',
                                'kleur',
                                'carrosserie',
                                'bouwjaar',
                                'apk_datum'
                            ],
                            'techniek' => [
                                'bandenmaat_voor',
                                'bandenmaat_achter',
                                'bandenspanning_voor',
                                'bandenspanning_achter',
                                'olie'
                            ],
                            'aankoop' => [
                                'aankoop_datum',
                                'aankoop_kmstand',
                                'aankoop_bedrijf'
                            ],
                            'verzekering' => [
                                'belasting_per_maand',
                                'verzekering_per_maand',
                                'verzekeringsmaatschappij',
                                'verzekerings_type',
                                'polisnummer',
                                'energielabel',
                                'emissieklasse'
                            ]
                        ];

                        foreach ($fields as $group => $groupFields) {
                            echo "<div id='$group' class='details'>";
                            echo "<h2>$group</h2>";
                            echo "<table class='list'>";
                            echo "<tr hidden><td colspan='2'><strong>$group</strong></td></tr>";
                            foreach ($groupFields as $field) {
                                $value = $row[str_replace(" ", "_", $field)];
                                $field = str_replace("_", " ", $field);
                                if ($field === 'aankoop_bedrijf') {
                                    $value = $bedrijven[$value];
                                }
                                echo "<tr>";
                                echo "<td>" . $field . "</td>";
                                echo "<td>" . $value . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
                        }
                        // Laad tankinformatie
                        $sql = "SELECT * FROM tankinformatie WHERE voertuig_id = $id ORDER BY kilometerstand ASC";
                        $result = $conn->query($sql);

                        echo "<div id='tankinformatie' class='details'>";
                        echo "<h2>tankinformatie</h2>";
//--------

// Bereken de gereden kilometers sinds de aankoop van de auto
$sql = "SELECT aankoop_kmstand FROM voertuigen WHERE id = $id";
$result2 = $conn->query($sql);
$kilometerstandAankoop = $result2->fetch_assoc()['aankoop_kmstand'];

$sql = "SELECT MAX(kilometerstand) AS hoogsteKilometerstand FROM tankinformatie WHERE voertuig_id = $id";
$result2 = $conn->query($sql);
$huidigeKilometerstand = $result2->fetch_assoc()['hoogsteKilometerstand'];

$geredenKilometers = $huidigeKilometerstand - $kilometerstandAankoop;

// Retrieve the last two records from the tankinformatie table
$sql = "SELECT kilometerstand, liter
        FROM tankinformatie
        WHERE voertuig_id = $id
        ORDER BY kilometerstand DESC
        LIMIT 2";
$result = $conn->query($sql);
$records = $result->fetch_all(MYSQLI_ASSOC);

if (count($records) === 2) {
    $hoogsteKilometerstand = $records[0]['kilometerstand'];
    $opNaHoogsteKilometerstand = $records[1]['kilometerstand'];
    $liter = $records[0]['liter'];

    $kilometerVerschil = $hoogsteKilometerstand - $opNaHoogsteKilometerstand;
    echo $hoogsteKilometerstand . " - " . $opNaHoogsteKilometerstand . "<br>";
    echo $kilometerVerschil . "<br>";

    if ($liter !== 0) {
        $verbruik = $liter / $kilometerVerschil;
        echo "Verbruik tussen de laatste twee tankbeurten: " . $verbruik . " liter/km";
    } else {
        echo "Het aantal liters bij de hoogste kilometerstand is 0. Kan geen verbruik berekenen.";
    }
} else {
    echo "Er zijn onvoldoende records beschikbaar om het verbruik te berekenen.";
}


// Bereken het gemiddelde brandstofverbruik
$sql = "SELECT SUM(liter) AS totaalVerbruik, MAX(kilometerstand) AS hoogsteKilometerstand FROM tankinformatie WHERE voertuig_id = $id ORDER BY kilometerstand DESC LIMIT 2";
$result2 = $conn->query($sql);
$row = $result2->fetch_assoc();
$totaalVerbruik = $row['totaalVerbruik'];
$totaalKilometers = $row['hoogsteKilometerstand'];
$gemiddeldVerbruik = $totaalVerbruik / $totaalKilometers;

// Weergave van de gereden kilometers en het gemiddelde brandstofverbruik boven de tabel
echo "<div>Gereden kilometers sinds aankoop: $geredenKilometers</div>";
echo "<div>Gemiddeld brandstofverbruik: $gemiddeldVerbruik liter/km</div>";

// Weergave van het gemiddelde verbruik
if ($totaalKilometers > 0 && $totaalVerbruik > 0) {
    $verbruikPerKilometer = 1 / $gemiddeldVerbruik;
    echo "Gemiddeld verbruik: 1 op " . round($verbruikPerKilometer, 2);
} else {
    echo "Geen tankinformatie beschikbaar.";
}


//------
                        echo "<form action='save.php?page=tankinformatie' id='tankinformatie' method='POST' enctype='multipart/form-data'>";
                        echo "<table class='list'>";
                        echo "<tr>";
                        echo "<th onclick='location.href='?tab=tanken&sort=datum''>datum<i class='fas fa-sort'></i></th>";
                        echo "<th onclick='location.href='?tab=tanken&sort=tijd''>tijd<i class='fas fa-sort'></i></th>";
                        echo "<th onclick='location.href='?tab=tanken&sort=liter''>liter<i class='fas fa-sort'></i></th>";
                        echo "<th onclick='location.href='?tab=tanken&sort=prijs''>prijs<i class='fas fa-sort'></i></th>";
                        echo "<th onclick='location.href='?tab=tanken&sort=kilometerstand''>KM stand<i class='fas fa-sort'></i></th>";
                        echo "</tr>";
            
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr onclick='selectRow(this, " . $row['id'] . ", \"tankinformatie\")'>";
                                echo "<td>" . $row['datum'] . "</td>";
                                echo "<td>" . $row['tijd'] . "</td>";
                                echo "<td>" . $row['liter'] . "</td>";
                                echo "<td>" . $row['prijs'] . "</td>";
                                echo "<td>" . $row['kilometerstand'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Geen tankinformatie gevonden</td></tr>";
                        }

                        // Invoervelden voor nieuwe informatie
                        echo "<tr>";
                        echo "<td hidden><input type='text' name='voertuig_id' value='" . $id . "'>";
                        echo "<td><input type='text' id='datum' name='datum' placeholder='Datum'></td>";
                        echo "<td><input type='text' name='tijd' placeholder='Tijd'></td>";
                        echo "<td><input type='text' name='liter' placeholder='Liter'></td>";
                        echo "<td><input type='text' name='prijs' placeholder='Prijs'></td>";
                        echo "<td><input type='text' name='kilometerstand' placeholder='KM stand'></td>";
                        echo "</tr>";

                        echo "</table>";
                        echo "<input type='submit' value='Tankinformatie opslaan'>";
                        echo "</form>";
                        echo "</div>";
                    }
                }
            }

            disconnectFromDatabase($conn);
        ?>
    </body>
</html>
