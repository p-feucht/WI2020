function Quadrat() {
    var eingabe = document.getElementById('Eingabe');
    var Ergebnis = Eingabe.value * Eingabe.value;
    alert("Das Quadrat von " + Eingabe.value + " = " + Ergebnis);
}

var los = document.getElementById('los');
los.addEventListener('click', Quadrat, true);