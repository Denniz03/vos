<?php
    // Inclusie van het bestand 'functions.php'
    include 'functions.php';

    // Verbind met database
    $conn = connectToDatabase();

    // Verwerking van de POST-gegevens 
    processPostData();

    // Verwerking van de GET-gegevens
    $page = $_GET['page'];

    // Voer script uit op basis van pagina
    if ($page == 'voertuig') {

        // SQL-query om het voertuig op te slaan in de database
        $sql = "INSERT INTO voertuigen (kenteken, merk, model, uitvoering, brandstof, kleur, carrosserie, bouwjaar, apk_datum, aankoop_datum, aankoop_kmstand, aankoop_bedrijf, bandenmaat_voor, bandenmaat_achter, bandenspanning_voor, bandenspanning_achter, olie, belasting_per_maand, verzekering_per_maand, verzekeringsmaatschappij, verzekerings_type, polisnummer, energielabel, emissieklasse) 
        VALUES ('$kenteken', '$merk', '$model', '$uitvoering', '$brandstof', '$kleur', '$carrosserie', '$bouwjaar', '$apk_datum', '$aankoop_datum', '$aankoop_kmstand', '$aankoop_bedrijf', '$bandenmaat_voor', '$bandenmaat_achter', '$bandenspanning_voor', '$bandenspanning_achter', '$olie', '$belasting_per_maand', '$verzekering_per_maand', '$verzekeringsmaatschappij', '$verzekerings_type', '$polisnummer', '$energielabel', '$emissieklasse')";

    } else if ($page == 'bedrijf') {

        // SQL-query om het bedrijf op te slaan in de database
        $sql = "INSERT INTO bedrijven (naam, straat, huisnummer, postcode, plaats, land, telefoon, email, website, bedrijfstype)
        VALUES ('$naam', '$straat', '$huisnummer', '$postcode', '$plaats', '$land', '$telefoon', '$email', '$website', '$bedrijfstype')";

    } else if ($page == 'tankinformatie') {

        // SQL-query om de tankinformatie op te slaan in de database
        $sql = "INSERT INTO tankinformatie (voertuig_id, datum, tijd, liter, prijs, kilometerstand)
            VALUES ('$voertuig_id', '$datum', '$tijd', '$liter', '$prijs', '$kilometerstand')";

    } else if ($page == 'onderhoud') {

        // SQL-query om het onderhoud op te slaan in de database
        $sql = "INSERT INTO onderoud (voertuig_id, datum, tijd, liter, prijs, kilometerstand)
            VALUES ('$voertuig_id', '$datum', '$tijd', '$liter', '$prijs', '$kilometerstand')";

    }

    // Het uitvoeren van de SQL-query en controleren of deze succesvol was
    if ($conn->query($sql) === TRUE) {
        echo $page . " succesvol opgeslagen";
    } else {
        echo "Fout bij het opslaan van de " + $page + ": " . $conn->error;
    }

    // Verbreek de verbinding met de database
    disconnectFromDatabase($conn);

    // Terug naar de vorige pagina of naar index.php
    header("Location: index.php");
    exit();
?>
