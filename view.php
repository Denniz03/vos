<?php
$servername = "localhost";
$username = "denniz03";
$password = "gxd7Hv";
$database = "vos";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "SELECT * FROM voertuigen WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Toon de gegevens van het voertuig
    echo "Kenteken: " . $row['kenteken'] . "<br>";
    echo "Merk: " . $row['merk'] . "<br>";
    echo "Model: " . $row['model'] . "<br>";
    // Toon andere velden van het voertuig

    // Voeg hier de code toe om de tankhistorie en onderhoudshistorie weer te geven
} else {
    echo "Voertuig niet gevonden";
}

$conn->close();
?>
