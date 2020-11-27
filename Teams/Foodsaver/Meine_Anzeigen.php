<?php
session_start();
?>
<!doctype html>

<html lang="de">

<head>
  <meta charset="UTF-8">
  <title>Foodsaver - Too Good to Waste</title>
  <meta name="description" content="Webseite zur Vermeidung von Lebensmittelverschwendung">
  <link href="Metadaten/design.css" rel="stylesheet">
  <link href="Metadaten/meine_anzeigen.css" rel="stylesheet">
  <script src="RecordsDropdown.js" type="text/javascript"></script>
  <link rel="icon" href="Pictures/Logo_Bild.png" />

</head>

<body>
  <?php
  require("Metadaten/chooseHeader.php");
  ?>
  <main>

    <?php
    //Auflisten der Anzeigen
    require('database/MeineAnzeigenDB.php');
    ?>

    </div>
  </main>
  <?php
  require("Metadaten/footer.php");
  if (isset($_SESSION['session_user'])) {
    echo ('<script src="autologout.js" type="text/javascript"></script>');
  }
  ?>


  <div id="myModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
      </div>
      <div class="modal-body">
        <p>Möchten Sie diese Anzeige wirklich löschen?</br></p>
        <p>Sie können diese Anzeige später wieder aktivieren!</p>
        <button id="myBtnDeleteNein" name="myBtnDeleteRecNein">Nein</button>
        <form id="deleteProfile" action="" method="POST">
          <button id="myBtnDeleteJa" name="myBtnDeleteRecJa" type="submit" value="Yes">Ja</button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>



    <script>
      function showDeleteFunction(btn_id) {

        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn" + btn_id);
        var btnvalue = parseInt(btn.value);
        var action = "database/editFoodInfo.php?id=" + btnvalue;

        var btnNo = document.getElementById("myBtnDeleteNein");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
          modal.style.display = "block";
          document.getElementById("deleteProfile").setAttribute("action", action);
        }

        btnNo.onclick = function() {
          modal.style.display = "none";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      }
    </script>

</body>

</html>