<?php
$servername = "localhost";
$username = "denniz03";
$password = "gxd7Hv";
$database = "vos";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$naam = mysqli_real_escape_string($conn, $_POST['naam']);
$adres = mysqli_real_escape_string($conn, $_POST['adres']);
$postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
$plaats = mysqli_real_escape_string($conn, $_POST['plaats']);
$telefoon = mysqli_real_escape_string($conn, $_POST['telefoon']);
$bedrijftype = mysqli_real_escape_string($conn, $_POST['bedrijftype']);
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
