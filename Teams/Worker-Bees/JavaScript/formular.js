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
        $(this).val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'));
    });

    $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    })
}



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


    if (!timePeriodInputIsOk()) {
        document.getElementById("FehlermeldungZeitraum").innerHTML = "Bitte gültigen Zeitraum eingeben";
        document.getElementById("datefilter").focus();
        return false;
    } else { document.getElementById("FehlermeldungZeitraum").innerHTML = "*"; }

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
    if (document.formularFuerAngebot.Ort.value == "") {
        document.getElementById("FehlermeldungOrt").innerHTML = "Bitte Ort eingeben";
        document.getElementById("OrtID").focus();
        return false;
    } else { document.getElementById("FehlermeldungOrt").innerHTML = "*"; }
    if (checkPLZ() == false) {
        checkPLZ();
        return false;
    } else {
        document.getElementById("FehlermeldungPLZ").innerHTML = "*";
        return true;
    }

}

function timePeriodInputIsOk() {
    var timePeriod = document.formularFuerAngebot.datefilter.value; // datefilter should have a format like "DD.MM.YYYY - DD.MM.YYYY"
    var timeWithoutSpace = timePeriod.replace(" ", ""); // delete whitespaces
    var timePeriodNumbers = timePeriod.replace(/\D+/g, ""); // delete all non-number-digits

    //Validation 1
    var laenge = timePeriodNumbers.length; // after removing all non-numbers length must be 16
    if (laenge != 16) {
        return false;
    }
    let firstDate = timeWithoutSpace.substr(0, 10);
    let secondDate = timeWithoutSpace.substr(10);

    //validation 2 : there must be three parts (for day,month and year) between the points of a date.
    var firstDateArray = firstDate.split('.');
    if (firstDateArray.length != 3) {
        return false;
    }
    var secondDateArray = secondDate.split('.');
    if (secondDateArray.length != 3) {
        return false;
    }
    return true;

}


function checkPLZ() {
    var plz = document.formularFuerAngebot.PLZ.value;
    var laenge = plz.length;
    var anzahl = document.getElementById("plzinput").getAttributeNode("maxlength").nodeValue;
    if (laenge != anzahl) {
        document.getElementById("FehlermeldungPLZ").innerHTML = "Bitte " + anzahl + "-stellige PLZ eingeben! Sie haben " + laenge + " Stelle(n) eingegeben";
        document.getElementById("plzinput").focus();
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




/*
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
}*/