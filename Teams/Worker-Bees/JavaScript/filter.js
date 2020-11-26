function filterOffers() {

    var freetext = document.getElementById("free-text").value;
    var what = freetext.toLowerCase()

    var locationInput = document.getElementById("autocomplete").value;
    var where = locationInput.toLowerCase();

    var searchDate = document.getElementById("date-search").value;
    var when = new Date(searchDate);


    var allCards = document.getElementsByClassName("card");

    for (var i = 0; i < allCards.length; i++) {

        allCards[i].style.display = "block"; //set back all cards, in case they were filtered out before

        var title = allCards[i].querySelector("#cardTitle").textContent.toLowerCase();
        var location = allCards[i].querySelector("#cardLocation").textContent.toLowerCase();
        var start = new Date(allCards[i].querySelector("#startDate").value);
        var end = new Date(allCards[i].querySelector("#endDate").value);

        if ((what != "") && !(title.includes(what))) {
            allCards[i].style.display = "none"; //hide card if it does not contain Search in Title
        }
        if ((where != "") && !(location.includes(where))) {
            allCards[i].style.display = "none"; //hide card if it does not contain location
        }
        if ((searchDate) && (when < start || when > end)) {
            allCards[i].style.display = "none"; //hide card if it does not contain date
        }

    }

    // delete text in search fields
    document.getElementById("free-text").value = "";
    document.getElementById("autocomplete").value = "";
    document.getElementById("date-search").value = "";
}