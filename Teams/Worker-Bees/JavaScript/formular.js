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
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
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

/*
function pruefeFormular() {

    var formValid = true;
    var radios = document.getElementsByName("kategorie");

    if (document.formularFuerAngebot.title.value == "") {
        document.getElementById("FehlermeldungTitle").innerHTML = "Bitte Angebotstitel eingeben";
        //   alert("Bitte gib einen Angebotstitel ein.");
        // document.Formular.title.focus();
        formValid = false;
    } else { document.getElementById("FehlermeldungTitle").innerHTML = ""; }

    if (document.formularFuerAngebot.beschreibung.value.trim() == "") {
        document.getElementById("FehlermeldungBeschr").innerHTML = "Bitte Angebotsbeschreibung eingeben";
        //alert("Bitte gib eine Angebotsbeschreibung ein.");
        // document.Formular.beschreibung.focus();
        formValid = false;
    } else { document.getElementById("FehlermeldungBeschr").innerHTML = ""; }

    if (!radioIsValid()) {
        formValid = false;
    }
    return formValid;
}


function radioIsValid() {
    var i = 0;
    formValid = false;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;
    }

    if (!formValid) {
        alert("Bitte wähle eine Angebotskategorie aus, bevor du fortfährst");
    }
    return formValid;
}*/



function pruefeFormular() {

    if (document.formularFuerAngebot.title.value == "") {
        document.getElementById("FehlermeldungTitle").innerHTML = "Bitte Angebotstitel eingeben";
        //   alert("Bitte gib einen Angebotstitel ein.");
        // document.Formular.title.focus();
        return false;
    }
    if (!CheckPLZ()) {
        return false;
    }

    //Beschreibung soll kein Muss-Feld sein
    /* else if (document.formularFuerAngebot.beschreibung.value == "") {
            document.getElementById("FehlermeldungBeschr").innerHTML = "Bitte Angebotsbeschreibung eingeben";
            //alert("Bitte gib eine Angebotsbeschreibung ein.");
            // document.Formular.beschreibung.focus();
            return false;
        }*/

    var formValid = false;
    var radios = document.getElementsByName("kategorie");
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




function CheckPLZ() {
    var plz = document.formularFuerAngebot.PLZ.value;
    var laenge = plz.length;
    var anzahl = document.getElementById("plzinput").getAttributeNode("maxlength").nodeValue;
    if (laenge != anzahl) {
        //window.alert("Bitte " + anzahl + "-stellige PLZ eingeben! Sie haben nur " + laenge + " Stelle(n) eingegeben!");
        document.getElementById("FehlermeldungPLZ").innerHTML = "Bitte " + anzahl + "-stellige PLZ eingeben! Sie haben nur " + laenge + " Stelle(n) eingegeben!";
        document.formularFuerAngebot.PLZ.focus();
        return false();
    }
    if (laenge == anzahl) {
        if (isNaN(plz)) {
            document.getElementById("FehlermeldungPLZ").innerHTML += ", bitte nur Zahlen eingeben";
        }
        return true();
    }
}