<html>
<!-- Nachrichteneingabefeld mit Sendenbutton -->
<div id="nachrichtenEingabe">
    <form method="POST">
        <textarea id="textareaNachrichtenEingabe" name="nachricht" placeholder="Nachricht eingeben" tabindex="1"><?php if (isset($_SESSION['annotation2'])) {
                                                                                                                        echo ($_SESSION['annotation2']);
                                                                                                                    } else {
                                                                                                                        echo "";
                                                                                                                    } ?></textarea>
        <button name="senden" type="submit" id="senden" tabindex="1" data-submit="...Sending">Senden</button>
    </form>
</div>

</html>
<?php
//Nachrichteneingabe verwalten und in die Datenbank hochladen
if (isset($_POST['senden'])) {
    unset($_POST['senden']);
    if (isset($_SESSION['session_user'])) {
        if (!empty($_POST['nachricht'])) {
            require('connectDB.php');
            $annotation2 = $_POST['nachricht'];
            $username = $_SESSION['session_username'];
            $record_id = (int)$_GET['id'];
            $vorname = $_SESSION['session_firstname'];
            $nachname = $_SESSION['session_lastname'];
            $email = $_SESSION['session_user'];
            $telefon = $_SESSION['session_tel'];
            $date = date("Y-m-d H:i:s");
            $neu = 1;
            $empfänger = "";
            if (isset($_GET['user'])) {
                $empfänger = $_GET['user'];
            } elseif (isset($_GET['userid'])) {
                $empfänger = $_GET['userid'];
            } else {
                $sql = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE ID = $record_id");
                $stmt2 = mysqli_fetch_array($sql);
                $empfänger = $stmt2['Username'];
            }


            $INSERT = "INSERT Into `Nachrichten` (Benutzername, Empfänger, Nachricht, RecordID, Zeitpunkt, neu) values(?, ?, ?, ?, ?, ?)";

            $stmt = $db_link->prepare($INSERT);
            $stmt->bind_param("sssisi", $username, $empfänger, $annotation2, $record_id, $date, $neu);
            $stmt->execute();
            echo ($stmt->error);
            if (isset($_GET['user']) and isset($_GET['id'])) {
                $user = $_GET['user'];
                echo "<script> document.location.reload(true);window.location.href='../order_food.php?id=" . $record_id . "&user=" . $user . "&sd=1';</script>";
                #header('Location: '. $_SESSION['last_page']);
            } elseif (isset($_GET['id'])) {
                echo "<script> document.location.reload(true);window.location.href='../order_food.php?id=" . $record_id . "&sd=1';</script>";
                #header('Location: '. $_SESSION['last_page']);
            } elseif (isset($_GET['userid'])) {
                $userid = $_GET['userid'];
                echo "<script> document.location.reload(true);window.location.href='../profile.php?userid=" . $userid . "&sd=1'; </script>";
            }
        }
    } else {
        $_SESSION['annotation2'] = $annotation2;
        echo ("<script>alert('Bitte loggen Sie sich ein um eine Nachricht zu schreiben!');
        window.location.href='../order_food.php?id=" . $record_id . "&sd=1';</script>");
    }
}
echo ('<script>$("#listmessages").scrollTop($("#listmessages")[0].scrollHeight);</script>');
?>