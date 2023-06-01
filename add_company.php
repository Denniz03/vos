<!DOCTYPE html>
<html>
<head>
    <title>Bedrijf Toevoegen</title>
</head>
<body>
    <h1>Bedrijf Toevoegen</h1>
    <form action="save_company.php" method="POST">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required><br><br>

        <label for="adres">Adres:</label>
        <input type="text" id="adres" name="adres" required><br><br>

        <label for="postcode">Postcode:</label>
        <input type="text" id="postcode" name="postcode" required><br><br>

        <label for="plaats">Plaats:</label>
        <input type="text" id="plaats" name="plaats" required><br><br>

        <label for="telefoon">Telefoon:</label>
        <input type="text" id="telefoon" name="telefoon" required><br><br>

        <label for="bedrijftype">Bedrijfstype:</label>
        <select id="bedrijftype" name="bedrijftype" required>
            <option value="">Selecteer bedrijfstype</option>
            <option value="Autoschadeherstel">Autoschadeherstel</option>
            <option value="Autoverhuur">Autoverhuur</option>
            <option value="Autokeuring">Autokeuring</option>
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
