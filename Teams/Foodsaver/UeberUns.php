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
  <link href="Metadaten/bottomnav.css" rel="stylesheet">
  <link rel="icon" href="Pictures/Logo_Bild.png" />
</head>

<body>

  <?php
  require("Metadaten/chooseHeader.php");
  ?>

  <div id="ueberuns">
    <img src="Pictures/Logo.png"></img>
    <p>Diese Webseite wurde in Form eines Projektes in der Vorlesung "Webprogrammierung" erstellt.</p>

    </br>

    <p>Dabei bestand das Team aus den Mitgliedern:</p>
    <li>Christoph Zengerle</li>
    <li>Linus Göhl</li>
    <li>Ngoc My Tran</li>

    </br>

    <p>Der Zweck dieser Webseite ist wie der Name schon sagt, Lebensmittel zu retten.
      Dies wird durch das Verkaufen von übrig gebliebenen Mahlzeiten und andere Lebensmittel
      zu einem günstigen Preis erreicht.
      </br>
      Dadurch soll die Wertschätzung für Lebensmittel gestärkt und die Verschwendung eingedämmt werden,
      wodurch auch die CO2-Emission vermieden wird.
      Doch das ist nicht das einzige Ziel unserer Webseite!
      Hiermit sollen auch die kleinen Lokale und die Studenten unterstützt werden.
      Während die einen sich freuen, weil sie keine Essensreste wegschmeißen müssen,
      freuen sich die anderen über das gesparte Geld.
    </p>
  </div>

  <?php
  require("Metadaten/footer.php");
  ?>

</body>

</html>