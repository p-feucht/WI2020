
<?php
//Filter in die Url einfügen uns seite neu laden
if (isset($_POST['apply_filter'])) {
    $Kategorie = $_POST['categorie'];
    $Kueche = $_POST['kitchen'];
    $Preis = $_POST['price'];
    $Entfernung = $_POST['distance'];
    echo "<script> document.location.reload(true);window.location.href='../index.php?Kategorie=" . $Kategorie . "&Kueche=" . $Kueche . "&Preis=" . $Preis . "&Entfernung=" . $Entfernung . "';</script>";
}

if (isset($_POST['reset_filter'])) {
    echo "<script> document.location.reload(true);window.location.href='../index.php';</script>";
}

?>