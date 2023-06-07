<?php
    include 'functions.php';
?>    
<!DOCTYPE html>
<html>
<head>
    <title>Voertuig toevoegen</title>
    <meta charset="utf-8">
    <meta name="robots" content="none">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=yes">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script src="java/java.js?<?php echo time(); ?>"></script>
</head>
<body>
    <h1>Voertuig toevoegen</h1>
    <form action="save.php?page=voertuig" method="POST">

        <label for="kenteken">Kenteken:</label>
        <input type="text" id="kenteken" name="kenteken" required value="<?php echo isset($_SESSION['kenteken']) ? $_SESSION['kenteken'] : ''; ?>"><br><br>

        <label for="merk">Merk:</label>
        <input type="text" id="merk" name="merk" required><br><br>

        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required><br><br>

        <label for="uitvoering">Uitvoering:</label>
        <input type="text" id="uitvoering" name="uitvoering"><br><br>

        <label for="brandstof">Brandstof:</label>
        <select id="brandstof" name="brandstof">
            <option value="">Selecteer een brandstof</option>
            <option value="Aardgas">Aardgas</option>
            <option value="Benzine">Benzine</option>
            <option value="Diesel">Diesel</option>
            <option value="Elektrisch">Elektrisch</option>
            <option value="Hybride">Hybride</option>
            <option value="LPG">LPG</option>
            <option value="Waterstof">Waterstof</option>
        </select><br><br>

        <label for="kleur">Kleur:</label>
        <input type="text" id="kleur" name="kleur"><br><br>

        <label for="carrosserie">Carrosserie:</label>
        <select id="carrosserie" name="carrosserie">
            <option value="">Selecteer een carrosserievorm</option>
            <option value="Bestelbus">Bestelbus</option>
            <option value="Cabriolet">Cabriolet</option>
            <option value="Coupé">Coupé</option>
            <option value="Hatchback">Hatchback</option>
            <option value="MPV">MPV</option>
            <option value="Motorfiets">Motorfiets</option>
            <option value="Scooter">Scooter</option>
            <option value="Sedan">Sedan</option>
            <option value="Stationwagen">Stationwagen</option>
            <option value="SUV">SUV</option>
        </select><br><br>

        <label for="bouwjaar">Bouwjaar:</label>
        <input type="text" id="bouwjaar" name="bouwjaar"><br><br>

        <label for="apk_datum">APK Datum:</label>
        <input type="text" id="apk_datum" name="apk_datum"><br><br>

        <label for="aankoop_datum">Aankoop Datum:</label>
        <input type="text" id="aankoop_datum" name="aankoop_datum"><br><br>

        <label for="aankoop_kmstand">Aankoop Kilometerstand:</label>
        <input type="text" id="aankoop_kmstand" name="aankoop_kmstand"><br><br>

        <label for="aankoop_bedrijf">Aankoop Bedrijf:</label>
        <select id="aankoop_bedrijf" name="aankoop_bedrijf">
            <?php
                // Opties genereren voor het selectieveld op basis van de opgehaalde bedrijven
                $bedrijven = getCompanys();
                foreach ($bedrijven as $id => $bedrijf) {
                    echo "<option value=\"$id\">$bedrijf</option>";
                }
            ?>
        </select>
        <button onclick="window.location.href='add_company.php'">Bedrijf toevoegen</button><br><br>

        <label for="bandenmaat_voor">Bandenmaat voor:</label>
        <input type="text" id="bandenmaat_voor" name="bandenmaat_voor" class="bandenmaat-input"><br><br>

        <label for="bandenmaat_achter">Bandenmaat achter:</label>
        <input type="text" id="bandenmaat_achter" name="bandenmaat_achter" class="bandenmaat-input"><br><br>

        <label for="bandenspanning_voor">Bandenspanning voor:</label>
        <select id="bandenspanning_voor" name="bandenspanning_voor">
            <option value="">Selecteer de bandenspanning</option>
            <option value="1.8">1.8 bar</option>
            <option value="1.9">1.9 bar</option>
            <option value="2.0">2.0 bar</option>
            <option value="2.1">2.1 bar</option>
            <option value="2.2">2.2 bar</option>
            <option value="2.3">2.3 bar</option>
            <option value="2.4">2.4 bar</option>
            <option value="2.5">2.5 bar</option>
            <option value="2.6">2.6 bar</option>
            <option value="2.7">2.7 bar</option>
            <option value="2.8">2.8 bar</option>
            <option value="2.9">2.9 bar</option>
            <option value="3.0">3.0 bar</option>
            <option value="3.1">3.1 bar</option>
            <option value="3.2">3.2 bar</option>
            <option value="3.3">3.3 bar</option>
            <option value="3.4">3.4 bar</option>
        </select><br><br>

        <label for="bandenspanning_achter">Bandenspanning achter:</label>
        <select id="bandenspanning_achter" name="bandenspanning_achter">
            <option value="1.8">1.8 bar</option>
            <option value="1.9">1.9 bar</option>
            <option value="2.0">2.0 bar</option>
            <option value="2.1">2.1 bar</option>
            <option value="2.2">2.2 bar</option>
            <option value="2.3">2.3 bar</option>
            <option value="2.4">2.4 bar</option>
            <option value="2.5">2.5 bar</option>
            <option value="2.6">2.6 bar</option>
            <option value="2.7">2.7 bar</option>
            <option value="2.8">2.8 bar</option>
            <option value="2.9">2.9 bar</option>
            <option value="3.0">3.0 bar</option>
            <option value="3.1">3.1 bar</option>
            <option value="3.2">3.2 bar</option>
            <option value="3.3">3.3 bar</option>
            <option value="3.4">3.4 bar</option>
        </select><br><br>

        <label for="olie">Olie:</label>
        <select id="olie" name="olie">
            <option value="">Selecteer een olie type</option>
            <optgroup label="Auto's">
                <option value="SAE 0W-20">SAE 0W-20</option>
                <option value="SAE 5W-30">SAE 5W-30</option>
                <option value="SAE 10W-40">SAE 10W-40</option>
                <option value="SAE 15W-40">SAE 15W-40</option>
                <option value="SAE 20W-50">SAE 20W-50</option>
            </optgroup>
            <optgroup label="Motoren">
                <option value="SAE 10W-30">SAE 10W-30</option>
                <option value="SAE 10W-40">SAE 10W-40</option>
                <option value="SAE 15W-50">SAE 15W-50</option>
                <option value="SAE 20W-50">SAE 20W-50</option>
                <option value="SAE 10W-60">SAE 10W-60</option>
            </optgroup>
        </select><br><br>

        <label for="belasting_per_maand">Belasting per maand:</label>
        <input type="text" id="belasting_per_maand" name="belasting_per_maand"><br><br>

        <label for="verzekering_per_maand">Verzekering per maand:</label>
        <input type="text" id="verzekering_per_maand" name="verzekering_per_maand"><br><br>

        <label for="verzekeringsmaatschappij">Verzekeringsmaatschappij:</label>
        <select id="verzekeringsmaatschappij" name="verzekeringsmaatschappij">
            <?php
                // Opties genereren voor het selectieveld op basis van de opgehaalde bedrijven
                $bedrijven = getCompanys();
                foreach ($bedrijven as $id => $bedrijf) {
                    echo "<option value=\"$id\">$bedrijf</option>";
                }
            ?>
        </select>
        <button onclick="window.location.href='add_company.php'">Bedrijf toevoegen</button><br><br>

        <label for="verzekerings_type">Verzekerings type:</label>
        <select id="verzekerings_type" name="verzekerings_type">
            <option value="">Selecteer verzekerings type</option>
            <option value="Ongevallenverzekering">Ongevallenverzekering</option>
            <option value="Rechtsbijstandsverzekering">Rechtsbijstandsverzekering</option>
            <option value="Schadeverzekering inzittenden">Schadeverzekering inzittenden</option>
            <option value="WA">WA (Wettelijke Aansprakelijkheid)</option>
            <option value="WA Beperkt Casco">WA Beperkt Casco</option>
            <option value="WA Extra">WA Extra</option>
            <option value="WA+">WA+</option>
            <option value="WA Volledig Casco">WA Volledig Casco</option>
        </select><br><br>

        <label for="polisnummer">Polisnummer:</label>
        <input type="text" id="polisnummer" name="polisnummer"><br><br>

        <label for="energielabel">Energielabel:</label>
        <select id="energielabel" name="energielabel">
            <option value="">Selecteer energielabel</option>
            <option value="A">A</option>
            <option value="A+">A+</option>
            <option value="A++">A++</option>
            <option value="A+++">A+++</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
            <option value="G">G</option>
        </select><br><br>

        <label for="emissieklasse">Emissieklasse:</label>
        <select id="emissieklasse" name="emissieklasse">
            <option value="">Selecteer emissieklasse</option>
            <option value="Euro 1">Euro 1</option>
            <option value="Euro 2">Euro 2</option>
            <option value="Euro 3">Euro 3</option>
            <option value="Euro 4">Euro 4</option>
            <option value="Euro 5">Euro 5</option>
            <option value="Euro 6">Euro 6</option>
            <option value="Euro 6d">Euro 6d</option>
            <option value="Euro 6d-TEMP">Euro 6d-TEMP</option>
        </select><br><br>

        <input type="submit" value="Voertuig opslaan">
    </form>
</body>
</html>
