function filterOffers() {

    var what = document.getElementById("free-text").value.toLowerCase();
    var where = document.getElementById("autocomplete").value.toLowerCase();
    var when = document.getElementById("date-werkzeug").value.toLowerCase();

    var allCards = document.getElementsByClassName("card");

    for(var i=0; i<allCards.length; i++) {

        allCards[i].style.display = "block"; //set back each card, in case it was filtered out before
        
        var content = allCards[i].textContent.toLowerCase(); //get whole card content

        if (!(content.includes(what))) {
            allCards[i].style.display = "none"; //hide card if it does not contain wanted filter
        }
        if (!(content.includes(where))) {
            allCards[i].style.display = "none"; //hide card if it does not contain wanted filter
        }

    }

    // delete text in search fields
    document.getElementById("free-text").value = "";
    document.getElementById("autocomplete").value = "";
    document.getElementById("date-werkzeug").value = "";
}