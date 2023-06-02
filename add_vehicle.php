<!DOCTYPE html>
<html>
<head>
    <title>Voertuig toevoegen</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $("#bouwjaar").datepicker({
                dateFormat: "mm-yy",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                onClose: function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                }
            });
            $("#apk_datum").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
            });
            $("#aankoop_datum").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
            });
            // Haal de bedrijven op via een Ajax-verzoek
            $.ajax({
                url: "get_company.php", // De URL van het PHP-bestand dat de bedrijven ophaalt
                dataType: "json",
                success: function(data) {
                var selectOptions = "";
                // Genereer de opties voor de selectielijst met de bedrijfsnamen
                for (var i = 0; i < data.length; i++) {
                    selectOptions += "<option value='" + data[i].id + "'>" + data[i].naam + "</option>";
                }
                // Voeg de opties toe aan de selectielijst
                $("#aankoop_bedrijf, #verzekeringsmaatschappij").html(selectOptions);
                }
            });
        });
    </script>
</head>
<body>
    <h2>Voertuig toevoegen</h2>
    <form action="save_vehicle.php" method="POST">
        <label for="kenteken">Kenteken:</label>
        <input type="text" id="kenteken" name="kenteken" required><br><br>

        <label for="merk">Merk:</label>
        <select id="merk" name="merk" required>
        <option value="">Selecteer een merk</option>
        <optgroup label="Auto's">
            <option value="Alfa Romeo">Alfa Romeo</option>
            <option value="Audi">Audi</option>
            <option value="Bentley">Bentley</option>
            <option value="BMW">BMW</option>
            <option value="Chevrolet">Chevrolet</option>
            <option value="Ferrari">Ferrari</option>
            <option value="Fiat">Fiat</option>
            <option value="Ford">Ford</option>
            <option value="Honda">Honda</option>
            <option value="Hyundai">Hyundai</option>
            <option value="Jaguar">Jaguar</option>
            <option value="Jeep">Jeep</option>
            <option value="Kia">Kia</option>
            <option value="Lamborghini">Lamborghini</option>
            <option value="Land Rover">Land Rover</option>
            <option value="Lexus">Lexus</option>
            <option value="Maserati">Maserati</option>
            <option value="Mazda">Mazda</option>
            <option value="McLaren">McLaren</option>
            <option value="Mercedes-Benz">Mercedes-Benz</option>
            <option value="Nissan">Nissan</option>
            <option value="Opel">Opel</option>
            <option value="Peugeot">Peugeot</option>
            <option value="Porsche">Porsche</option>
            <option value="Renault">Renault</option>
            <option value="Rolls-Royce">Rolls-Royce</option>
            <option value="Seat">Seat</option>
            <option value="Subaru">Subaru</option>
            <option value="Tesla">Tesla</option>
            <option value="Toyota">Toyota</option>
            <option value="Volkswagen">Volkswagen</option>
            <option value="Volvo">Volvo</option>
        </optgroup>
        <optgroup label="Motorfietsen">
            <option value="Aprilia">Aprilia</option>
            <option value="Bajaj">Bajaj</option>
            <option value="Benelli">Benelli</option>
            <option value="Bimota">Bimota</option>
            <option value="BMW Motorrad">BMW Motorrad</option>
            <option value="Cagiva">Cagiva</option>
            <option value="Ducati">Ducati</option>
            <option value="GasGas">GasGas</option>
            <option value="Harley-Davidson">Harley-Davidson</option>
            <option value="Honda">Honda</option>
            <option value="Husqvarna Motorcycles">Husqvarna Motorcycles</option>
            <option value="Indian">Indian</option>
            <option value="Kawasaki">Kawasaki</option>
            <option value="KTM">KTM</option>
            <option value="Moto Guzzi">Moto Guzzi</option>
            <option value="MV Agusta">MV Agusta</option>
            <option value="Piaggio">Piaggio</option>
            <option value="Royal Enfield">Royal Enfield</option>
            <option value="Suzuki">Suzuki</option>
            <option value="SWM Motorcycles">SWM Motorcycles</option>
            <option value="Triumph">Triumph</option>
            <option value="Vespa">Vespa</option>
            <option value="Yamaha">Yamaha</option>
        </optgroup>
        </select><br><br>


        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required><br><br>

        <label for="uitvoering">Uitvoering:</label>
        <input type="text" id="uitvoering" name="uitvoering"><br><br>

        <label for="brandstof">Brandstof:</label>
        <select id="brandstof" name="brandstof">
            <option value="">Selecteer een brandstof</option>
            <option value="Benzine">Benzine</option>
            <option value="Diesel">Diesel</option>
            <option value="LPG">LPG</option>
            <option value="Elektrisch">Elektrisch</option>
            <option value="Hybride">Hybride</option>
            <option value="Waterstof">Waterstof</option>
            <option value="Aardgas">Aardgas</option>
        </select><br><br>

        <label for="kleur">Kleur:</label>
        <input type="text" id="kleur" name="kleur"><br><br>

        <label for="carrosserie">Carrosserie:</label>
        <select id="carrosserie" name="carrosserie">
            <option value="">Selecteer een carrosserievorm</option>
            <option value="Sedan">Sedan</option>
            <option value="Hatchback">Hatchback</option>
            <option value="Stationwagen">Stationwagen</option>
            <option value="SUV">SUV</option>
            <option value="Cabriolet">Cabriolet</option>
            <option value="Coupé">Coupé</option>
            <option value="MPV">MPV</option>
            <option value="Bestelbus">Bestelbus</option>
            <option value="Motorfiets">Motorfiets</option>
            <option value="Scooter">Scooter</option>
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
        <select id="aankoop_bedrijf" name="aankoop_bedrijf"></select>
        <button onclick="window.location.href='add_company.php'">Bedrijf toevoegen</button><br><br>

        <label for="bandenmaat_voor">Bandenmaat voor:</label>
        <input type="text" id="bandenmaat_voor" name="bandenmaat_voor"><br><br>

        <label for="bandenmaat_achter">Bandenmaat achter:</label>
        <input type="text" id="bandenmaat_achter" name="bandenmaat_achter"><br><br>

        <label for="bandenspanning_voor">Bandenspanning voor:</label>
        <input type="text" id="bandenspanning_voor" name="bandenspanning_voor"><br><br>

        <label for="bandenspanning_achter">Bandenspanning achter:</label>
        <input type="text" id="bandenspanning_achter" name="bandenspanning_achter"><br><br>

        <label for="olie">Olie:</label>
        <input type="text" id="olie" name="olie"><br><br>

        <label for="belasting_per_maand">Belasting per maand:</label>
        <input type="text" id="belasting_per_maand" name="belasting_per_maand"><br><br>

        <label for="verzekering_per_maand">Verzekering per maand:</label>
        <input type="text" id="verzekering_per_maand" name="verzekering_per_maand"><br><br>

        <label for="verzekeringsmaatschappij">Verzekeringsmaatschappij:</label>
        <select id="verzekeringsmaatschappij" name="verzekeringsmaatschappij"></select>
        <button onclick="window.location.href='add_company.php'">Bedrijf toevoegen</button><br><br>

        <label for="verzekerings_type">Verzekerings type:</label>
        <input type="text" id="verzekerings_type" name="verzekerings_type"><br><br>

        <label for="polisnummer">Polisnummer:</label>
        <input type="text" id="polisnummer" name="polisnummer"><br><br>

        <label for="energielabel">Energielabel:</label>
        <input type="text" id="energielabel" name="energielabel"><br><br>

        <label for="emissieklasse">Emissieklasse:</label>
        <input type="text" id="emissieklasse" name="emissieklasse"><br><br>

        <input type="submit" value="Voertuig opslaan">
    </form>
</body>
</html>
