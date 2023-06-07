$(document).ready(function() {

    // Initialisatie van de datumkiezer voor het veld "bouwjaar"
    $("#bouwjaar").datepicker({
        dateFormat: "mm-yy",        // Datumnotatie: maand-jaar (bijv. 06-2023)
        changeMonth: true,          // Mogelijkheid om de maand te wijzigen
        changeYear: true,           // Mogelijkheid om het jaar te wijzigen
        showButtonPanel: true,      // Weergave van een paneel met knoppen onder de datumkiezer
        onClose: function(dateText, inst) {
            // Bij het sluiten van de datumkiezer, stel de geselecteerde datum in als de eerste dag van die maand
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });

    // Initialisatie van de datumkiezer voor het veld "apk_datum"
    $("#apk_datum").datepicker({
        dateFormat: "dd-mm-yy",     // Datumnotatie: dag-maand-jaar (bijv. 31-05-2023)
        changeMonth: true,          // Mogelijkheid om de maand te wijzigen
        changeYear: true            // Mogelijkheid om het jaar te wijzigen
    });

    // Initialisatie van de datumkiezer voor het veld "aankoop_datum"
    $("#aankoop_datum").datepicker({
        dateFormat: "dd-mm-yy",     // Datumnotatie: dag-maand-jaar (bijv. 31-05-2023)
        changeMonth: true,          // Mogelijkheid om de maand te wijzigen
        changeYear: true            // Mogelijkheid om het jaar te wijzigen
    });

    // Initialisatie van de datumkiezer voor het veld "datum"
    $("#datum").datepicker({
        dateFormat: "dd-mm-yy",     // Datumnotatie: dag-maand-jaar (bijv. 31-05-2023)
        changeMonth: true,          // Mogelijkheid om de maand te wijzigen
        changeYear: true            // Mogelijkheid om het jaar te wijzigen
    });

    // Functie om een tabblad te openen
    function openTab(tabName) {
        var tabcontent = $(".tab-content");
        var tablinks = $("#tabs .tab-button");
        tabcontent.removeClass("active");
        $("#content").hide();
        tablinks.removeClass("active");
        $("#" + tabName).addClass("active");
        $("button[data-tab='" + tabName + "']").addClass("active");
    }

    // Eventlistener voor het klikken op een tabknop
    $("#tabs .tab-button").click(function() {
        var tabName = $(this).data("tab");
        openTab(tabName);
    });

    // Eventlistener voor het klikken op een voertuigen tabknop
    $("#voertuigen-tabs .tab-button").click(function() {
        var tabName = $(this).data("tab");
        var tablinks = $("#voertuigen-tabs .tab-button");
        tablinks.removeClass("active");
        $("#" + tabName).addClass("active");
        $("button[data-tab='" + tabName + "']").addClass("active");
        $(".details").hide();
        $("#" + tabName + "").show();
    });

    // Functie om de tabbladpagina te openen op basis van de URL-parameter
    function openTabFromURL() {
        var urlParams = new URLSearchParams(window.location.search);
        var tabName = urlParams.get("tab");
        if (tabName) {
            openTab(tabName);
        } else {
            openTab("voertuigen"); // Standaard tabblad
        }
    }

    // Open het juiste tabblad bij het laden van de pagina
    openTabFromURL();

    // Verwijder de URL-parameters
    var url = window.location.href.split('?')[0];
    window.history.replaceState({}, document.title, url);

    // Initialisatie van het inputmasker voor velden met de klasse "bandenmaat-input"
    $(".bandenmaat-input").inputmask("999/99 R99", {
        placeholder: "999/99 R99",   // Weergave van een voorbeeld in het invoerveld
        clearIncomplete: true        // Wis onvolledige invoer bij het verlaten van het veld
    });
    
    // Selecteer het inputveld voor het kenteken
    const inputKenteken = document.getElementById('kenteken');

    // Voeg een 'input' eventlistener toe aan het inputveld
    inputKenteken.addEventListener('input', function() {
        formatKenteken();
    });

    // Voeg een 'blur' eventlistener toe aan het inputveld
    inputKenteken.addEventListener('blur', function() {
        formatKenteken();
    });

    // Functie om het kenteken te formatteren
    function formatKenteken() {
        // Haal de ingevoerde waarde op
        let kenteken = inputKenteken.value.toUpperCase();

        // Verwijder eventuele '-' tekens uit de ingevoerde waarde
        kenteken = kenteken.replace(/-/g, '');

        // Voeg een '-' in tussen de letters en cijfers
        const formattedKenteken = kenteken.replace(/([A-Z]+|\d+)/g, '$1-');

        // Verwijder het laatste streepje als het geen letter of cijfer volgt
        const cleanedKenteken = formattedKenteken.replace(/-$/, '');

        // Wijs de geformatteerde waarde toe aan het inputveld
        inputKenteken.value = cleanedKenteken;

        // Haal de voertuiginformatie op als het kenteken een geldige lengte heeft
        if (cleanedKenteken.length === 6) {
            // Maak een API-aanroep om voertuiginformatie op te halen
            fetch(`https://opendata.rdw.nl/resource/qyrd-w56j.json?kenteken=${cleanedKenteken}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.success) {
                    const voertuig = data.vehicle;
                    console.log('Merk:', voertuig.brand);
                    console.log('Model:', voertuig.model);
                    console.log('Kleur:', voertuig.color);
                    console.log('Bouwjaar:', voertuig.constructionYear);
                    // Voeg andere gewenste informatie toe
                } else {
                    console.error('Fout bij het ophalen van voertuiginformatie');
                }
            })
            .catch(error => {
                console.error('Fout bij het ophalen van voertuiginformatie:', error);
            });
        }
    }

    // Eventlistener voor het indienen van het formulier
    $('#tankform').submit(function(e) {
        e.preventDefault(); // Voorkom standaard formulierindiening

        // Verzamel de formuliergegevens
        var formData = $(this).serialize();

        // AJAX-aanroep om het formulier in een extern onzichtbaar scherm te verwerken
        $.ajax({
        url: 'save.php?page=tankinformatie', // De URL van het externe verwerkingsbestand
        type: 'POST', // HTTP-methode: POST
        data: formData, // De formuliergegevens
        success: function(response) {
            // Succesvolle respons ontvangen van het externe verwerkingsbestand

            // Laad alleen de specifieke div opnieuw
            $('#content').load('mydiv_content.php #myDiv');

            // Voer andere acties uit na het vernieuwen van de div, indien nodig
        },
        error: function(xhr, status, error) {
            // Fout bij het verwerken van het formulier
            console.log(error); // Toon de foutmelding in de console
        }
        });
    });

});