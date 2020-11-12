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
}*/


/*function radioIsValid() {
    var i = 0;
    formValid = false;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;
    }

    if (!formValid) {
        document.getElementById("FehlermeldungAngebKat").innerHTML = "Bitte Kategorie eingeben";
        document.getElementByID("wz").focus();
        //alert("Bitte wähle eine Angebotskategorie aus, bevor du fortfährst");
    }
    return formValid;
}*/



function pruefeFormular() {


    if (document.getElementById("ws").checked == false && document.getElementById("wz").checked == false && document.getElementById("dl").checked == false) {
        document.getElementById("FehlermeldungAngebKat").innerHTML = "Bitte Kategorie eingeben";
        document.getElementById("wz").focus();
        return false;
    } else { document.getElementById("FehlermeldungAngebKat").innerHTML = "*"; }

    if (document.formularFuerAngebot.title.value == "") {
        document.getElementById("FehlermeldungTitle").innerHTML = "Bitte Angebotstitel eingeben";
        document.getElementById("title").focus();
        return false;
    } else { document.getElementById("FehlermeldungTitle").innerHTML = "*"; }

    if (document.formularFuerAngebot.Vorname.value == "") {
        document.getElementById("FehlermeldungVorname").innerHTML = "Bitte Vorname eingeben";
        document.getElementById("Vorname").focus();
        return false;
    } else { document.getElementById("FehlermeldungVorname").innerHTML = "*"; }

    if (document.formularFuerAngebot.Nachname.value == "") {
        document.getElementById("FehlermeldungNachname").innerHTML = "Bitte Nachname eingeben";
        document.getElementById("Nachname").focus();
        return false;
    } else { document.getElementById("FehlermeldungNachname").innerHTML = "*"; }

    if (document.formularFuerAngebot.Strasse.value == "") {
        document.getElementById("FehlermeldungStrasse").innerHTML = "Bitte Straße eingeben";
        document.getElementById("StrasseID").focus();
        return false;
    } else { document.getElementById("FehlermeldungStrasse").innerHTML = "*"; }

    if (document.formularFuerAngebot.Hnr.value == "") {
        document.getElementById("FehlermeldungHnr").innerHTML = "Bitte Hausnummer eingeben";
        document.getElementById("HnrID").focus();
        return false;
    } else { document.getElementById("FehlermeldungHnr").innerHTML = "*"; }
    if (CheckPLZ() == false) {
        CheckPLZ();
        return false;
    } else { document.getElementById("FehlermeldungPLZ").innerHTML = "*"; }
    if (document.formularFuerAngebot.Ort.value == "") {
        document.getElementById("FehlermeldungOrt").innerHTML = "Bitte Ort eingeben";
        document.getElementById("OrtID").focus();
        return false;
    } else { document.getElementById("FehlermeldungOrt").innerHTML = "*"; }


    return true;
    /*let vorname = document.getElementByName("Vorname");
    if (inputIsEmpty(vorname) == true) {
        let vornameErrMess = document.getElementById("FehlermeldungVorname");
        setErrorMessage(vornameErrMess, "Bitte Vornamen eingeben");
        return false;*/
}


function CheckPLZ() {
    var plz = document.formularFuerAngebot.PLZ.value;
    var laenge = plz.length;
    var anzahl = document.getElementById("plzinput").getAttributeNode("maxlength").nodeValue;
    if (laenge != anzahl) {
        //window.alert("Bitte " + anzahl + "-stellige PLZ eingeben! Sie haben nur " + laenge + " Stelle(n) eingegeben!");
        document.getElementById("FehlermeldungPLZ").innerHTML = "Bitte " + anzahl + "-stellige PLZ eingeben! Sie haben nur " + laenge + " Stelle(n) eingegeben!";
        document.getElementById("plzinput").focus();
        //document.formularFuerAngebot.PLZ.focus();
        return false;
    }
    if (laenge == anzahl) {
        if (isNaN(plz)) {
            document.getElementById("FehlermeldungPLZ").innerHTML += ", bitte nur Zahlen eingeben";
            return false;
        }
        return true();
    }
}

function inputIsEmpty(InputElement) {

    if (InputElement.value == "") {
        return true;
    } else {
        return false;
    }
}

function setErrorMessage(elementErrorMessage, errorMessage) {

    elementErrorMessage.innerHTML = errorMessage;
    elementErrorMessage.focus();
}