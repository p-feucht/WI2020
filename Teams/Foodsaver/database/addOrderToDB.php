<?php
if (isset($_POST['submit'])) {
    $record_id = (int)$_GET['id'];

    $sql = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE ID = $record_id");
    $stmt2 = mysqli_fetch_array($sql);
    $Menge = $stmt2['Menge'];
    $vorname = $_SESSION['session_firstname'];
    $nachname = $_SESSION['session_lastname'];
    $email = $_SESSION['session_user'];
    $telefon = $_SESSION['session_tel'];
    $verkäufer = $stmt2['Email'];
    $verkäuferUser = $stmt2['Username'];
    $username = $_SESSION['session_username'];
    $date = date("Y-m-d H:i:s");

    if(!empty($_POST['amount'])){
        $amount = $_POST['amount'];
    }
    else{
        $amount = 0;
    }
    if(!empty($_POST['annotation'])){
        $annotation = $_POST['annotation'];
    }else{
        $annotation = "";
    }

    if($amount>$Menge){
        $_SESSION['annotation'] = $annotation;
        echo"<script> window.location.href='../order_food.php?id=".$record_id."';</script>";
    }else{
        if(isset($_SESSION['session_user'])){
    require('connectDB.php');
    $INSERT = "INSERT Into `Bestellungsanfragen` (Menge, Anmerkung, Record_ID, Vorname, Nachname, Email, Telefonnummer, Bestelldatum, Verkäufer, Username, 	VerkäuferUsername) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $db_link->prepare($INSERT);
    $stmt->bind_param("isissssssss", $amount, $annotation, $record_id, $vorname, $nachname, $email, $telefon, $date, $verkäufer, $username, $verkäuferUser);
    $stmt->execute();
    echo ($stmt->error);

    $new_mnenge = $Menge - $amount;

    $sql2 = mysqli_query($db_link, "UPDATE tbl_records set Menge=$new_mnenge where ID=$record_id");

    $sql = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE ID = $record_id");
    $query = mysqli_fetch_array($sql);
    if($query['Menge'] <= 0){
        $sql2 = mysqli_query($db_link, "UPDATE tbl_records set Visable = 1 where ID=$record_id");
    }
    $neu = 1;

    $INSERT2 = "INSERT Into `Nachrichten` (Benutzername, Nachricht, RecordID, Menge, Zeitpunkt, Empfänger, neu) values(?, ?, ?, ?, ?, ?, ?)";

    $stmt = $db_link->prepare($INSERT2);
    $stmt->bind_param("ssiissi", $username, $annotation, $record_id, $amount, $date, $verkäuferUser, $neu);
    $stmt->execute();
    echo ($stmt->error);
    unset($_SESSION['annotation']);
    unset($_SESSION['text']);
    unset($_SESSION['menge']);
    echo"<script>alert('Die Bestellung wurde erfolgreich abgeschickt'); 
    window.location.href='../order_food.php?id=".$record_id."';</script>";
    }
    else{
        $_SESSION['text'] = $annotation;
        $_SESSION['menge'] = $amount;
        echo("<script>alert('Bitte loggen Sie sich ein um eine Bestellung zu erteilen!');
        window.location.href='../order_food.php?id=".$record_id."';</script>");
    }
    }

}

?>

