var alter = '';
var eingabe = '';

name = prompt('Gib Alter an', alter);

if (alter) {
    eingabe = 'ist kein Alter, mach richtig';
} else {
    eingabe = 'ja passt';
}

alert(eingabe);