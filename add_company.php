<?php
    include 'functions.php';
?>    
<!DOCTYPE html>
<html>
<head>
    <title>Bedrijf Toevoegen</title>
    <meta charset="utf-8">
    <meta name="robots" content="none">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="images/logo.png">
    <meta name="format-detection" content="telephone=yes">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            // Eventlistener voor het invoerveld van de postcode
            $("#postcode").on("blur", function() {
                var postcode = $(this).val();
                if (postcode.length === 6) {
                    getAddressFromPostcode(postcode);
                }
            });

            // Functie om adresgegevens op te halen op basis van postcode
            function getAddressFromPostcode(postcode) {
                // API-url om postcodegegevens op te halen (gebruik de API Postcode)
                var apiUrl = "https://api.postcodedata.nl/v1/postcode/?postcode=" + postcode;

                // Voer een AJAX-verzoek uit naar de API
                $.ajax({
                    url: apiUrl,
                    success: function(data) {
                        if (data.status === "ok" && data.details) {
                            var address = data.details;
                            var street = address.street;
                            var city = address.city.label;

                            // Update de straat en woonplaats in de bijbehorende velden
                            $("#adres").val(street);
                            $("#plaats").val(city);
                        } else {
                            // Geen adresgegevens gevonden voor de opgegeven postcode
                            console.log("Geen adresgegevens gevonden.");
                        }
                    },
                    error: function() {
                        // Fout bij het ophalen van adresgegevens
                        console.log("Er is een fout opgetreden bij het ophalen van adresgegevens.");
                    }
                });
            }
        });
    </script>
</head>
<body>
    <h1>Bedrijf Toevoegen</h1>
    <form action="save.php?page=bedrijf" method="POST">
    <label class="form-label" for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required><br><br>

    <label class="form-label" for="straat">Straat:</label>
    <input type="text" id="straat" name="straat" required><br><br>

    <label class="form-label" for="huisnummer">Huisnummer:</label>
    <input type="text" id="huisnummer" name="huisnummer" required><br><br>

    <label class="form-label" for="postcode">Postcode:</label>
    <input type="text" id="postcode" name="postcode" required><br><br>

    <label class="form-label" for="plaats">Plaats:</label>
    <input type="text" id="plaats" name="plaats" required><br><br>

    <label class="form-label" for="land">Land:</label>
        <select id="land" name="land" required>
        <option value="">Selecteer een land</option>
        <option value="Nederland">Nederland</option>
        <option value="België">België</option>
        <option value="Duitsland">Duitsland</option>
        <option value="Frankrijk">Frankrijk</option>
    </select><br><br>

    <label class="form-label" for="telefoon">Telefoon:</label>
    <input type="text" id="telefoon" name="telefoon" required><br><br>

    <label class="form-label" for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>

    <label class="form-label" for="website">Website:</label>
    <input type="url" id="website" name="website"><br><br>

    <label class="form-label" for="bedrijfstype">Bedrijfstype:</label>
    <select id="bedrijfstype" name="bedrijfstype" required>
        <option value="">Selecteer bedrijfstype</option>
        <option value="Autoschadeherstel">Autoschadeherstel</option>
        <option value="Autoverhuur">Autoverhuur</option>
        <option value="Autokeuring">Autokeuring</option>
        <option value="Dealer">Dealer</option>
        <option value="Garage">Garage</option>
        <option value="Motorverzekering">Motorverzekering</option>
        <option value="Motorzaak">Motorzaak</option>
        <option value="Tankstation">Tankstation</option>
        <option value="Verhuur">Verhuur</option>
        <option value="Verzekeringsmaatschappij">Verzekeringsmaatschappij</option>
        <option value="Winkel">Winkel</option>
    </select><br><br>

    <input type="submit" value="Opslaan">
</form>

</body>
</html>
