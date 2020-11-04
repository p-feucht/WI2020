<?php

session_start();

if (isset($_POST['submit'])) {

    if((!empty($_POST['food'])) and (!empty($_POST['amount'])) and (!empty($_POST['price']))){

    require("connectDB.php");

    $food = $_POST['food'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $date = date("Y-m-d H:i:s");
    $kategorie = $_POST['categorie'];
    $laenderkueche = $_POST['kitchen'];
    if(!isset($_POST['categorie'])){
        $kategorie = 'Sonstige';
    }
    if(!isset($_POST['kitchen'])){
        $laenderkueche = 'Sonstige';
    }

    if(!empty($_POST['nachname'])){
        $nachname = $_POST['nachname'];
    }
    else{
        $nachname = $_SESSION['session_lastname'];
    }
    if(!empty($_POST['vorname'])){
        $vorname = $_POST['vorname'];
    }
    else{
        $vorname = $_SESSION['session_firstname'];
    }
    if(!empty($_POST['company'])){
        $company = $_POST['company'];
    }
    else{
        $company = $_SESSION['session_company'];
    }
    if(!empty($_POST['street'])){
        $street = $_POST['street'];
    }
    else{
        $street = $_SESSION['session_street'];
    }
    if(!empty($_POST['hausnummer'])){
        $hausnummer = $_POST['hausnummer'];
    }
    else{
        $hausnummer = $_SESSION['session_housenr'];
    }
    if(!empty($_POST['plz'])){
        $plz = $_POST['plz'];
    }
    else{
        $plz = $_SESSION['session_plz'];
    }
    if(!empty($_POST['ort'])){
        $ort = $_POST['ort'];
    }
    else{
        $ort = $_SESSION['session_ort'];
    }
    if(!empty($_POST['telefon'])){
        $telefon = $_POST['telefon'];
    }
    else{
        $telefon = $_SESSION['session_tel'];
    }
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
    }
    else{
        $email = $_SESSION['session_user'];
    }

        $username = $_SESSION['session_username'];
    


    

    $INSERT = "INSERT Into `tbl_records` (Artikel, Beschreibung, Menge, Preis, Erstellungsdatum, Firma, Nachname, Vorname, Straße, Hausnummer, PLZ, Ort, Email, Telefonnummer, Username, Kategorie, LänderKüche) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $db_link->prepare($INSERT);
    $stmt->bind_param("sssssssssssssssss", $food, $description, $amount, $price, $date, $company, $nachname, $vorname, $street, $hausnummer, $plz, $ort, $email, $telefon, $username, $kategorie, $laenderkueche);
    $stmt->execute();
    echo ($stmt->error);

    $last_id = mysqli_insert_id($db_link);

    extract($_POST);
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    foreach($_FILES["image"]["tmp_name"] as $key=>$tmp_name) {
        $file_name=$_FILES["image"]["name"][$key];
        $file_tmp=$_FILES["image"]["tmp_name"][$key];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    
        if(in_array($ext,$extension)) {
            if(!file_exists("../uploads/".$file_name)) {
                move_uploaded_file($file_tmp=$_FILES["image"]["tmp_name"][$key],"../uploads/".$file_name);
                $imageLink = "../uploads/".$file_name;
                $imageType = $_FILES["image"]["type"][$key];
                

                $sql = "INSERT Into `Images` (imageName, imageType, imageLink, ArtikelID) values (?, ?, ?, ?)";
                $query = $db_link->prepare($sql);
                $query->bind_param("sssi", $file_name, $imageType, $imageLink, $last_id);
                $query->execute();
                echo ($query->error);

            }
            else {
                $filename=basename($file_name,$ext);
                $newFileName=$filename.time().".".$ext;
                move_uploaded_file($file_tmp=$_FILES["image"]["tmp_name"][$key],"../uploads/".$newFileName);
                $imageLink = "../uploads/".$newFileName;
                $imageType = $_FILES["image"]["type"][$key];
                

                $sql = "INSERT Into `Images` (imageName, imageType, imageLink, ArtikelID) values (?, ?, ?, ?)";
                $query = $db_link->prepare($sql);
                $query->bind_param("sssi", $newFileName, $imageType, $imageLink, $last_id);
                $query->execute();
                echo ($query->error);
            }

        }
        else {
            array_push($error,"$file_name, ");
        }
    }

     echo ($stmt->error);
    echo '<script>
        alert("Anzeige erfolgreich erstellt!");
        window.location.href="../order_food.php?id='.$last_id.'";
        </script>';
    $stmt->close();
    $db_link->close();

}
else{
    echo "<script>
        alert('Bitte alle Felder ausfüllen!');
        window.location.href='../add_food.php';
        </script>";
}
}

?>