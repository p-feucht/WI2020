var sortOrderListOfSeries = "alphabetical";

function onClickAlphabetical(){
  sortOrderListOfSeries = "alphabetical";
  showSelectedGenre();
}
function onClickRating(){
  sortOrderListOfSeries = "rating";
  showSelectedGenre();
}
function showSelectedGenre() {
  var e = document.getElementById("Genre");
  var result = e.options[e.selectedIndex].value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("listOfSeries").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "/php/seriesList.php?genreID=" + result + "&orderBy=" + sortOrderListOfSeries, true);
  xmlhttp.send();

}

  function addClass(){
    elem = document.getElementsByClassName('changePasswordWrapper');
    elem[0].classList.add("show");
  }

  function removeClass(){
    elem = document.getElementsByClassName('changePasswordWrapper');
    elem[0].classList.remove("show");
  }

