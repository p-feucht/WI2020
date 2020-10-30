// Automatic Slideshow - change image every 3 seconds
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) { myIndex = 1 }
    x[myIndex - 1].style.display = "block";
    setTimeout(carousel, 3000);
}



function datePicker() {

    $('input[name="datefilter"]').daterangepicker({
        autoApply: true,
        autoUpdateInput: false,
        multidate: true,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    })
}




/*
function datePicker() {
    $('.datefilter').datepicker({
        multidate: true,
        format: 'dd-mm-yyyy'
    });
}*/
function pruefeFormular() {

    var formValid = false;
    var radios = document.getElementsByName("kategorie");

    if (document.formularFuerAngebot.title.value == "") {
        document.getElementById("Fehlermeldung").innerHTML = "Bitte Angebotstitel eingeben";
        //   alert("Bitte gib einen Angebotstitel ein.");
        // document.Formular.title.focus();
        return false;
    }
    if (document.formularFuerAngebot.beschreibung.value == "") {
        document.getElementById("Fehlermeldung").innerHTML = "Bitte Angebotsbeschreibung eingeben";
        //alert("Bitte gib eine Angebotsbeschreibung ein.");
        // document.Formular.beschreibung.focus();
        return false;
    }
    
    var i = 0;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;
    }

    if (!formValid) {
        alert("Bitte wähle eine Angebotskategorie aus, bevor du fortfährst");
    }

    return formValid;
}