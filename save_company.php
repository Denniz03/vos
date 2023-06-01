<?php
$servername = "localhost";
$username = "denniz03";
$password = "gxd7Hv";
$database = "vos";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$naam = $_POST['naam'];
$adres = $_POST['adres'];
$postcode = $_POST['postcode'];
$plaats = $_POST['plaats'];
$telefoon = $_POST['telefoon'];
$bedrijftype = $_POST['bedrijftype'];
// Voeg hier andere velden toe indien nodig

$sql = "INSERT INTO bedrijven (naam, adres, postcode, plaats, telefoon, bedrijftype) 
        VALUES ('$naam', '$adres', '$postcode', '$plaats', '$telefoon', '$bedrijftype')";

if ($conn->query($sql) === TRUE) {
    echo "Bedrijf succesvol opgeslagen";
} else {
    echo "Fout bij het opslaan van het bedrijf: " . $conn->error;
}

$conn->close();
?>
