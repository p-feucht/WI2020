// Get the modal
var modal = document.getElementById('modalLogin');

// When the user clicks anywhere outside of the modal, close it
window.addEventListener("click", function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
});


function showSelectedGenre() {
  var e = document.getElementById("Genre");
  var result = e.options[e.selectedIndex].value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("listOfSeries").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "/php/seriesList.php?genreID=" + result, true);
  xmlhttp.send();

}

