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
  <link href="Metadaten/order.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
  <link rel="stylesheet" type="text/css" href="Here/demo.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="/FancyBox/jquery.fancybox.css" type="text/css" media="screen" />
  <script type="text/javascript" src="/FancyBox/jquery.fancybox.pack.js"></script>
  <script type="text/javascript" src="/FancyBox/jquery.mousewheel.pack.js"></script>
  <link rel="stylesheet" href="/FancyBox/jquery.fancybox-buttons.css" type="text/css" media="screen" />
  <script type="text/javascript" src="/FancyBox/jquery.fancybox-buttons.js"></script>

  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
  <script type="text/javascript">
    window.ENV_VARIABLE = 'https://foodsaver.bplaced.net'
  </script>
  <script src='https://developer.here.com/javascript/src/iframeheight.js'></script>
  <link rel="icon" href="Pictures/Logo_Bild.png" />
</head>

<body>
  <?php

  $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];

  require("Metadaten/chooseHeader.php");
  require('database/specificRecordDB.php');


  if ($_SESSION['session_user'] != $_SESSION['RecordEmail']) {
    require('database/checkOrderFood.php');
  }
  if ((isset($_SESSION['session_user'])) and ($_SESSION['session_user'] != $_SESSION['RecordEmail'])) {
    require("Here/sellerCords.php");
    require("Here/userCords.php");
  }
  require('database/addOrderToDB.php');
  require("database/updateMessagestoNotNew.php");
  require('database/listOrdersRecord.php');

  require("Metadaten/footer.php");
  if (isset($_GET['sd'])) {
    echo ('<script>window.scrollTo(0,document.body.scrollHeight);</script>');
  }
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
        <p>Möchten Sie diese Anzeige wirklich löschen?</p>
        <p>Sie können diese Anzeige später wieder aktivieren!</p>
        <button id="myBtnDeleteNein" name="myBtnDeleteRecNein">Nein</button>
        <form id="deleteProfile" action="database/editFoodInfo.php?id=<?php echo ($_GET['id']); ?>" method="POST">
          <button id="myBtnDeleteJa" name="myBtnDeleteRecJa" type="submit" value="Yes">Ja</button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>



    <script>
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      var btnNo = document.getElementById("myBtnDeleteNein");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on the button, open the modal
      btn.onclick = function() {
        modal.style.display = "block";
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
    </script>
</body>

</html>