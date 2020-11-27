//Funktion um beim Hinzufügen von einer Anzeige, mehrere Bilder hochzuladen
$(document).ready(function () {
  $("#upload_multiple_images").on("submit", function (event) {
    event.preventDefault();
    var image_name = $("#image").val();
    if (image_name == "") {
      alert("Please select image");
      return false;
    } else {
      $.ajax({
        url: "addFoodToDB.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          $("#image").val("");
        },
      });
    }
  });
});
