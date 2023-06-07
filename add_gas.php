<?php
    include 'functions.php';
?>    
<!DOCTYPE html>
<html>
<head>
    <title>Tankinformatie Toevoegen</title>
    <meta charset="utf-8">
    <meta name="robots" content="none">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=yes">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
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
            $("#datum").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
            });
        });
        
    </script>
</head>
<body>
    <h1>Tankinformatie Toevoegen</h1>
    <form action="save.php?page=tankinformatie" method="POST" enctype="multipart/form-data">
        <label class="form-label" for="voertuig_id">Voertuig ID:</label>
            <select id="voertuig_id" name="voertuig_id" required>
                <option value="">Selecteer een voertuig</option>
                <?php
                    // Opties genereren voor het selectieveld op basis van de opgehaalde voertuigen
                    $voertuigen = getVehicles();
                    foreach ($voertuigen as $id => $voertuig) {
                        echo "<option value=\"$id\">$voertuig</option>";
                    }
                ?>
            </select><br><br>

        <label class="form-label" for="datum">Datum:</label>
        <input type="text" id="datum" name="datum" required><br><br>

        <label class="form-label" for="tijd">Tijd:</label>
        <input type="time" id="tijd" name="tijd" required><br><br>

        <label class="form-label" for="liter">Liter:</label>
        <input type="number" id="liter" name="liter" step="0.01" pattern="\d+(\.\d{1,2})?" required><br><br>

        <label class="form-label" for="prijs">Prijs:</label>
        <input type="number" id="prijs" name="prijs" step="0.01" pattern="\d+(\.\d{1,2})?" required><br><br>

        <label class="form-label" for="kilometerstand">Kilometerstand:</label>
        <input type="number" id="kilometerstand" name="kilometerstand" required><br><br>

        <input type="submit" value="Opslaan">
    </form>
</body>
</html>
