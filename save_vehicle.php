<?php
$servername = "localhost";
$username = "denniz03";
$password = "gxd7Hv";
$database = "vos";

// Verbinding maken met de database
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ontvang de gegevens van het formulier
$kenteken = $_POST['kenteken'];
$merk = $_POST['merk'];
$model = $_POST['model'];
$uitvoering = $_POST['uitvoering'];
$brandstof = $_POST['brandstof'];
$kleur = $_POST['kleur'];
$carrosserie = $_POST['carrosserie'];
$bouwjaar = $_POST['bouwjaar'];
$apk_datum = $_POST['apk_datum'];
$aankoop_datum = $_POST['aankoop_datum'];
$aankoop_kmstand = $_POST['aankoop_kmstand'];
$aankoop_bedrijf = $_POST['aankoop_bedrijf'];
$bandenmaat_voor = $_POST['bandenmaat_voor'];
$bandenmaat_achter = $_POST['bandenmaat_achter'];
$bandenspanning_voor = $_POST['bandenspanning_voor'];
$bandenspanning_achter = $_POST['bandenspanning_achter'];
$olie = $_POST['olie'];
$belasting_per_maand = $_POST['belasting_per_maand'];
$verzekering_per_maand = $_POST['verzekering_per_maand'];
$verzekeringsmaatschappij = $_POST['verzekeringsmaatschappij'];
$verzekerings_type = $_POST['verzekerings_type'];
$polisnummer = $_POST['polisnummer'];
$energielabel = $_POST['energielabel'];
$emissieklasse = $_POST['emissieklasse'];

// SQL-query om het voertuig op te slaan in de database
$sql = "INSERT INTO voertuigen (kenteken, merk, model, uitvoering, brandstof, kleur, carrosserie, bouwjaar, apk_datum, aankoop_datum, aankoop_kmstand, aankoop_bedrijf, bandenmaat_voor, bandenmaat_achter, bandenspanning_voor, bandenspanning_achter, olie, belasting_per_maand, verzekering_per_maand, verzekeringsmaatschappij, verzekerings_type, polisnummer, energielabel, emissieklasse) VALUES ('$kenteken', '$merk', '$model', '$uitvoering', '$brandstof', '$kleur', '$carrosserie', '$bouwjaar', '$apk_datum', '$aankoop_datum', '$aankoop_kmstand', '$aankoop_bedrijf', '$bandenmaat_voor', '$bandenmaat_achter', '$bandenspanning_voor', '$bandenspanning_achter', '$olie', '$belasting_per_maand', '$verzekering_per_maand', '$verzekeringsmaatschappij', '$verzekerings_type', '$polisnummer', '$energielabel', '$emissieklasse')";

if ($conn->query($sql) === TRUE) {
    echo "Voertuig succesvol opgeslagen.";
} else {
    echo "Fout bij het opslaan van het voertuig: " . $conn->error;
}

$conn->close();
?>
