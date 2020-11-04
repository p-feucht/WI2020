<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


require('connectDB.php');

if(isset($_POST['submit'])){

if(!empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['password_re'])){
    
    $username = $_POST['username'];
    $nachname = $_POST['nachname'];
    $vorname = $_POST['vorname'];
    $company = $_POST['company'];
    $street = $_POST['street'];
    $number = $_POST['hausnummer'];
    $plz = $_POST['plz'];
    $ort = $_POST['ort'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_re = $_POST['password_re'];
    $telefon = $_POST['telefon'];
    $date = date("Y-m-d H:i:s");

    if($password == $password_re){

    $SELECTEMAIL = "SELECT Email From `tbl_contacts` Where Email = ? Limit 1";
    $SELECTUSER = "SELECT Benutzername From `tbl_contacts` Where Benutzername = ? Limit 1";
    $INSERT = "INSERT Into `tbl_contacts` (Benutzername, Nachname, Vorname, Firma, Straße, Hausnummer, PLZ, Ort, Email, Passwort, Telefonnummer, Erstellungsdatum, pictureLink) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $db_link->prepare($SELECTEMAIL);
    echo ($db_link->error);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    $stmt2 = $db_link->prepare($SELECTUSER);
    echo ($db_link->error);
    $stmt2->bind_param("s", $username);
    $stmt2->execute();
    $stmt2->bind_result($username);
    $stmt2->store_result();
    $rnum2 = $stmt2->num_rows;

    if (($rnum==0) and ($rnum2==0)) {
     $stmt->close();


     if((isset($_FILES["profileImage"]["tmp_name"])) and ($_FILES["profileImage"]["tmp_name"] != Null)){
        extract($_POST);
        $error=array();
        $extension=array("jpeg","jpg","png","gif");
            $file_name=$_FILES["profileImage"]["name"];
            $file_tmp=$_FILES["profileImage"]["tmp_name"];
            $ext=pathinfo($file_name,PATHINFO_EXTENSION);
        
            if(in_array($ext,$extension)) {
                if(!file_exists("../uploads/Profilbilder/".$file_name)) {
                    move_uploaded_file($file_tmp=$_FILES["profileImage"]["tmp_name"],"../uploads/Profilbilder/".$file_name);
                    $imageLink = "../uploads/Profilbilder/".$file_name;
                }
                else {
                    $filename=basename($file_name,$ext);
                    $newFileName=$filename.time().".".$ext;
                    move_uploaded_file($file_tmp=$_FILES["profileImage"]["tmp_name"],"../uploads/Profilbilder/".$newFileName);
                    $imageLink = "../uploads/Profilbilder/".$newFileName;

                }
            }
            else {
                array_push($error,"$file_name, ");
            }
   }

   else{
        $imageLink = "../uploads/Profilbilder/default_Profile_Picture.jpg";
   }
   


     $stmt = $db_link->prepare($INSERT);
     $stmt->bind_param("sssssssssssss",$username, $nachname, $vorname, $company, $street, $number, $plz, $ort, $email, $password, $telefon, $date, $imageLink);
     $stmt->execute();
     echo ($stmt->error);

     $sql = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE Email = '$email'");
     $row = mysqli_fetch_array($sql);




     $_SESSION['session_id'] = $row['ID'];
     $_SESSION['session_user'] = $row['Email'];
     $_SESSION['session_pwd'] = $row['Passwort'];
     $_SESSION['session_username'] = $row['Benutzername'];
     $_SESSION['session_company'] = $row['Firma'];
     $_SESSION['session_lastname'] = $row['Nachname'];
     $_SESSION['session_firstname'] = $row['Vorname'];
     $_SESSION['session_street'] = $row['Straße'];
     $_SESSION['session_housenr'] = $row['Hausnummer'];
     $_SESSION['session_plz'] = $row['PLZ'];
     $_SESSION['session_ort'] = $row['Ort'];
     $_SESSION['session_tel'] = $row['Telefonnummer'];

     $_SESSION['session_country'] = 'de';
     $_SESSION['last_login_timestamp'] = time();

     $ip = $_SERVER['REMOTE_ADDR'];
     $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
     $_SESSION['ip'] = $details->ip;
     $_SESSION['ip_loc'] = $details->loc;
     $_SESSION['ip_city'] = $details->city;
     $_SESSION['ip_country'] = $details->country;

     require('autoLoginAfterRegistragion.php');

    } else {    
        echo "<script>
        alert('Email or Username already in use!');
        window.location.href='../registrierung.php';
        </script>";    

    }
    $stmt->close();
    $db_link->close();
   }
   else{
       echo "<script>
       alert('Passwörter müssen übereinstimmen!');
       window.location.href='../registrierung.php';
       </script>";    

   }

}else{
    echo "<script>
    alert('Please fill in all neccessary fields!');
    window.location.href='../registrierung.php';
    </script>";    
 
}


exit();

}


?>

