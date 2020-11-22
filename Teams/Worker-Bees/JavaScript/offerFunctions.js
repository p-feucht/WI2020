function createAmenities(modalID, abohr, adrechsel, aschleif, asaege, akleinteil) {

    element = modalID.querySelector("#amenities");

    if (abohr == 1) {

    var node = document.createElement("LI");
    var textnode = document.createTextNode("Bohrmaschine");
    node.appendChild(textnode);
    element.appendChild(node);

        }

    if (adrechsel == 1) {

        var node = document.createElement("LI");
        var textnode = document.createTextNode("Drechselbank/Drehbank");
        node.appendChild(textnode);
        element.appendChild(node);
    
        }

    if (aschleif == 1) {

        var node = document.createElement("LI");
        var textnode = document.createTextNode("Schleifmaschine");
        node.appendChild(textnode);
        element.appendChild(node);
    
        }
    
    if (asaege == 1) {

        var node = document.createElement("LI");
        var textnode = document.createTextNode("elektrische Standsägen");
        node.appendChild(textnode);
        element.appendChild(node);
    
        }

    if (akleinteil == 1) {

        var node = document.createElement("LI");
        var textnode = document.createTextNode("Grundausstattung Kleinteile (Schrauben, Dübel, Nägel etc.) vorhanden und verwendbar");
        node.appendChild(textnode);
        element.appendChild(node);
    
        }
    
    }