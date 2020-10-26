<html>
<div id="nachrichtenEingabe">
    <form method="POST">
        <textarea id="textareaNachrichtenEingabe" name="nachricht" placeholder="Nachricht eingeben" tabindex="1"><?php if(isset($_SESSION['annotation2'])){echo ($_SESSION['annotation2']);} else{echo "";}?></textarea>
        <button name="senden" type="submit" id="senden" tabindex="1" data-submit="...Sending">Senden</button>
    </form>
</div>
</html>
<?php
    if (isset($_POST['senden'])) {
        if(isset($_SESSION['session_user'])){
        if(!empty($_POST['nachricht'])){
            $annotation2 = $_POST['nachricht'];
            $username = $_SESSION['session_username'];
            $record_id = (int)$_GET['id'];
            $vorname = $_SESSION['session_firstname'];
            $nachname = $_SESSION['session_lastname'];
            $email = $_SESSION['session_user'];
            $telefon = $_SESSION['session_tel'];
            $date = date("Y-m-d H:i:s");
            $empfänger = "";
            if(isset($_GET['user'])){
                $empfänger = $_GET['user'];
            }else{
                $sql = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE ID = $record_id");
                $stmt2 = mysqli_fetch_array($sql);
                $empfänger = $stmt2['Username'];
            }

            require('connectDB.php');
            $INSERT = "INSERT Into `Nachrichten` (Benutzername, Empfänger, Nachricht, RecordID, Zeitpunkt) values(?, ?, ?, ?, ?)";

            $stmt = $db_link->prepare($INSERT);
            $stmt->bind_param("sssis", $username, $empfänger, $annotation2, $record_id, $date);
            $stmt->execute();
            echo ($stmt->error);
            if(isset($_GET['user'])){
                $user = $_GET['user'];
                echo"<script> document.location.reload(true);window.location.href='../order_food.php?id=".$record_id."&user=".$user."';</script>";
            }
            }else{
                echo"<script> document.location.reload(true);window.location.href='../order_food.php?id=".$record_id."';</script>";
        }
    }
    else{
        $_SESSION['annotation2'] = $annotation2;
        echo("<script>alert('Bitte loggen Sie sich ein um eine Nachricht zu schreiben!');
        window.location.href='../order_food.php?id=".$record_id."';</script>");
    }
    }
?>