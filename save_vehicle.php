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
$kenteken = mysqli_real_escape_string($conn, $_POST['kenteken']);
$merk = mysqli_real_escape_string($conn, $_POST['merk']);
$model = mysqli_real_escape_string($conn, $_POST['model']);
$uitvoering = mysqli_real_escape_string($conn, $_POST['uitvoering']);
$brandstof = mysqli_real_escape_string($conn, $_POST['brandstof']);
$kleur = mysqli_real_escape_string($conn, $_POST['kleur']);
$carrosserie = mysqli_real_escape_string($conn, $_POST['carrosserie']);
$bouwjaar = mysqli_real_escape_string($conn, $_POST['bouwjaar']);
$apk_datum = mysqli_real_escape_string($conn, $_POST['apk_datum']);
$aankoop_datum = mysqli_real_escape_string($conn, $_POST['aankoop_datum']);
$aankoop_kmstand = mysqli_real_escape_string($conn, $_POST['aankoop_kmstand']);
$aankoop_bedrijf = mysqli_real_escape_string($conn, $_POST['aankoop_bedrijf']);
$bandenmaat_voor = mysqli_real_escape_string($conn, $_POST['bandenmaat_voor']);
$bandenmaat_achter = mysqli_real_escape_string($conn, $_POST['bandenmaat_achter']);
$bandenspanning_voor = mysqli_real_escape_string($conn, $_POST['bandenspanning_voor']);
$bandenspanning_achter = mysqli_real_escape_string($conn, $_POST['bandenspanning_achter']);
$olie = mysqli_real_escape_string($conn, $_POST['olie']);
$belasting_per_maand = mysqli_real_escape_string($conn, $_POST['belasting_per_maand']);
$verzekering_per_maand = mysqli_real_escape_string($conn, $_POST['verzekering_per_maand']);
$verzekeringsmaatschappij = mysqli_real_escape_string($conn, $_POST['verzekeringsmaatschappij']);
$verzekerings_type = mysqli_real_escape_string($conn, $_POST['verzekerings_type']);
$polisnummer = mysqli_real_escape_string($conn, $_POST['polisnummer']);
$energielabel = mysqli_real_escape_string($conn, $_POST['energielabel']);
$emissieklasse = mysqli_real_escape_string($conn, $_POST['emissieklasse']);

// SQL-query om het voertuig op te slaan in de database
$sql = "INSERT INTO voertuigen (kenteken, merk, model, uitvoering, brandstof, kleur, carrosserie, bouwjaar, apk_datum, aankoop_datum, aankoop_kmstand, aankoop_bedrijf, bandenmaat_voor, bandenmaat_achter, bandenspanning_voor, bandenspanning_achter, olie, belasting_per_maand, verzekering_per_maand, verzekeringsmaatschappij, verzekerings_type, polisnummer, energielabel, emissieklasse) VALUES ('$kenteken', '$merk', '$model', '$uitvoering', '$brandstof', '$kleur', '$carrosserie', '$bouwjaar', '$apk_datum', '$aankoop_datum', '$aankoop_kmstand', '$aankoop_bedrijf', '$bandenmaat_voor', '$bandenmaat_achter', '$bandenspanning_voor', '$bandenspanning_achter', '$olie', '$belasting_per_maand', '$verzekering_per_maand', '$verzekeringsmaatschappij', '$verzekerings_type', '$polisnummer', '$energielabel', '$emissieklasse')";

if ($conn->query($sql) === TRUE) {
    echo "Voertuig succesvol opgeslagen.";
} else {
    echo "Fout bij het opslaan van het voertuig: " . $conn->error;
}

$conn->close();
?>
