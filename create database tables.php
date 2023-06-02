<?php
    $servername = "localhost";
    $username = "denniz03";
    $password = "gxd7Hv";
    $database = "vos";

    // Verbinding maken met de database
    $conn = new mysqli($servername, $username, $password, $database);

    // Controleren op fouten bij het maken van de verbinding
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query om te controleren of de voertuigen tabel bestaat
    $query = "SELECT 1 FROM `vos`.`voertuigen` LIMIT 1";
    $result = $conn->query($query);

    // Als de voertuigen tabel niet bestaat, maak deze dan aan
    if (!$result) {
        $createTableQuery = "CREATE TABLE `vos`.`voertuigen` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `kenteken` VARCHAR(50) NOT NULL,
            `merk` VARCHAR(50) NOT NULL,
            `model` VARCHAR(50) NOT NULL,
            `uitvoering` VARCHAR(50) NOT NULL,
            `brandstof` VARCHAR(50) NOT NULL,
            `kleur` VARCHAR(50) NOT NULL,
            `carrosserie` VARCHAR(50) NOT NULL,
            `bouwjaar` INT NOT NULL,
            `apk_datum` DATE NOT NULL,
            `aankoop_datum` DATE NOT NULL,
            `aankoop_kmstand` INT NOT NULL,
            `aankoop_bedrijf` VARCHAR(50) NOT NULL,
            `bandenmaat_voor` VARCHAR(50) NOT NULL,
            `bandenmaat_achter` VARCHAR(50) NOT NULL,
            `bandenspanning_voor` INT NOT NULL,
            `bandenspanning_achter` INT NOT NULL,
            `olie` VARCHAR(50) NOT NULL,
            `belasting_per_maand` DECIMAL(10,2) NOT NULL,
            `verzekering_per_maand` DECIMAL(10,2) NOT NULL,
            `verzekeringsmaatschappij` VARCHAR(50) NOT NULL,
            `verzekerings_type` VARCHAR(50) NOT NULL,
            `polisnummer` VARCHAR(50) NOT NULL,
            `energielabel` VARCHAR(50) NOT NULL,
            `emissieklasse` VARCHAR(50) NOT NULL,
            PRIMARY KEY (`id`)
        )";
        $conn->query($createTableQuery);
    }

    // Query om te controleren of de bedrijven tabel bestaat
    $query = "SELECT 1 FROM `vos`.`bedrijven` LIMIT 1";
    $result = $conn->query($query);

    // Als de bedrijven tabel niet bestaat, maak deze dan aan
    if (!$result) {
        $createTableQuery = "CREATE TABLE `vos`.`bedrijven` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `naam` VARCHAR(50) NOT NULL,
            `adres` VARCHAR(100) NOT NULL,
            `postcode` VARCHAR(10) NOT NULL,
            `plaats` VARCHAR(50) NOT NULL,
            `telefoon` VARCHAR(20) NOT NULL,
            `bedrijftype` VARCHAR(50) NOT NULL,
            PRIMARY KEY (`id`)
        )";        
        $conn->query($createTableQuery);
    }

    $conn->close();
    ?>
