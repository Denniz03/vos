<?php
$servername = "localhost";
$username = "denniz03";
$password = "gxd7Hv";
$database = "vos";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bedrijven";
$result = $conn->query($sql);

$bedrijven = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bedrijf = array(
            'id' => $row['id'],
            'naam' => $row['naam'],
            'adres' => $row['adres'],
            'postcode' => $row['postcode'],
            'plaats' => $row['plaats'],
            'telefoon' => $row['telefoon'],
            'bedrijftype' => $row['bedrijftype']
            // Voeg hier andere velden toe als nodig
        );
        $bedrijven[] = $bedrijf;
    }
}

$conn->close();

// Stuur de bedrijfsgegevens terug als JSON
header('Content-Type: application/json');
echo json_encode($bedrijven);
?>
