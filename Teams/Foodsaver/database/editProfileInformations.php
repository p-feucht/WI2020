<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


require('connectDB.php');

if(isset($_POST['submit'])){

    
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

    

    $SELECTID = mysqli_query($db_link, "SELECT * From `tbl_contacts` Where Email = '$email' Limit 1");

    while($row = mysqli_fetch_array($SELECTID)){
    $id = $row['ID'];
    }

    if($password == $password_re){

    if (($username == $_SESSION['session_username']) and ($email == $_SESSION['session_user']) and ($password == $_SESSION['session_pwd'])) {
      
   
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
           $SELECTPICTURE = mysqli_query($db_link, "SELECT * From `tbl_contacts` WHERE ID = $id");
           while($rowImage = mysqli_fetch_array($SELECTPICTURE)){
           $imageLink = $rowImage['pictureLink'];
           }
        }
        
      
      $INSERT = "UPDATE `tbl_contacts` SET (Nachname = $nachname, Vorname = $vorname, Firma = $company, Straße = $street, Hausnummer = $number, 
      PLZ = $plz, Ort = $ort, Passwort = $password, Telefonnummer = $telefon, pictureLink = $imageLink) WHERE ID = $id";
   
   
       mysqli_query($db_link, $INSERT);
   
        $sql = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE ID = $id");
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
   
        require('autoLoginAfterRegistragion.php');
   
       }
       elseif(($username != $_SESSION['session_username']) or ($email != $_SESSION['session_user'])){

        $SELECTEMAIL = "SELECT Email From `tbl_contacts` Where Email = '$email' Limit 1";
        $SELECTUSER = "SELECT Benutzername From `tbl_contacts` Where Benutzername = '$username' Limit 1";
    
        
        $stmt = mysqli_query($db_link, $SELECTEMAIL);
        $stmt2 = mysqli_query($db_link, $SELECTUSER);

        $rnum = mysqli_num_rows($stmt);
        $rnum2 = mysqli_num_rows($stmt2);

    if (($rnum==0) or ($rnum2==0)) {
        if(($rnum==0) and ($rnum2==0)){
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
        $SELECTPICTURE = mysqli_query($db_link, "SELECT * From `tbl_contacts`");

        while($rowImage = mysqli_fetch_array($SELECTPICTURE)){
        $imageLink = $rowImage['pictureLink'];
        }
   }
   
   $INSERT = "UPDATE `tbl_contacts` SET (Benutzername = $username, Nachname = $nachname, Vorname = $vorname, Firma = $company, Straße = $street, Hausnummer = $number, 
   PLZ = $plz, Ort = $ort, Email = $email, Passwort = $password, Telefonnummer = $telefon, pictureLink = $imageLink) WHERE ID = $id";


    mysqli_query($db_link, $INSERT);

     $sql = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE ID = $id");
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

     require('autoLoginAfterRegistragion.php');

    } else {    
        echo "<script>
        alert('Email or Username already in use!');
        window.location.href='../registrierung.php';
        </script>";    

    }
    if($rnum==0){
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
           $SELECTPICTURE = "SELECT * From `tbl_contacts`";
           while($rowImage = mysqli_fetch_array($SELECTPICTURE)){
           $imageLink = $rowImage['pictureLink'];
           }
      }
      
      $INSERT = "UPDATE `tbl_contacts` SET (Nachname = $nachname, Vorname = $vorname, Firma = $company, Straße = $street, Hausnummer = $number, 
      PLZ = $plz, Ort = $ort, Email = $email, Passwort = $password, Telefonnummer = $telefon, pictureLink = $imageLink) WHERE ID = $id";
   
   
       mysqli_query($db_link, $INSERT);
   
        $sql = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE ID = $id");
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
   
        require('autoLoginAfterRegistragion.php');
   
       }
       if($rnum2==0){
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
           $SELECTPICTURE = "SELECT * From `tbl_contacts`";
           while($rowImage = mysqli_fetch_array($SELECTPICTURE)){
           $imageLink = $rowImage['pictureLink'];
           }
      }
      
      $INSERT = "UPDATE `tbl_contacts` SET (Nachname = $nachname, Vorname = $vorname, Firma = $company, Straße = $street, Hausnummer = $number, 
      PLZ = $plz, Ort = $ort, Passwort = $password, Telefonnummer = $telefon, pictureLink = $imageLink) WHERE ID = $id";
   
   
       mysqli_query($db_link, $INSERT);
   
        $sql = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE ID = $id");
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
   
        require('autoLoginAfterRegistragion.php');
   
       }
    }
    $stmt->close();
    $db_link->close();
   }
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


?>

