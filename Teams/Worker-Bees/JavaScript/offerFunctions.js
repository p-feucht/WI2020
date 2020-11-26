function createAmenities(modalID, abohr, adrechsel, aschleif, asaege, akleinteil) {

    element = modalID.querySelector("#amenities"); // get amenity list

    if (abohr == 1) { // add amenities from database

        var textnode = document.createTextNode("Bohrmaschine");
        createNode(textnode);

    }

    if (adrechsel == 1) {

        var textnode = document.createTextNode("Drechselbank/Drehbank");
        createNode(textnode);

    }

    if (aschleif == 1) {

        var textnode = document.createTextNode("Schleifmaschine");
        createNode(textnode);

    }

    if (asaege == 1) {

        var textnode = document.createTextNode("elektrische Standsägen");
        createNode(textnode);

    }

    if (akleinteil == 1) {

        var textnode = document.createTextNode("Grundausstattung Kleinteile (Schrauben, Dübel, Nägel etc.) vorhanden und verwendbar");
        createNode(textnode);
    }

}

function createNode(textnode) {
    var node = document.createElement("LI");
    node.appendChild(textnode);
    element.appendChild(node);
}