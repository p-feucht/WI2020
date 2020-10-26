<?php
session_start();

if (isset($_POST['submit'])) {

    require("connectDB.php");

    $user = $_POST['email'];
    $password = $_POST['password'];
    $date = date("Y-m-d H:i:s");


    $sql = "SELECT * FROM tbl_contacts WHERE Email = '$user' OR Benutzername = '$user'";
    $result = mysqli_query($db_link, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
        echo "<script>
        alert('No User found for entered Email or Username!');
        window.location.href='../login.php?user=".$user."';
        </script>";
        exit();
    } else {
      
        if ($row = mysqli_fetch_assoc($result)) {
            
            $dbpasswort = $row['Passwort'];
            if ($password != $dbpasswort) {
              echo "<script>
              alert('Wrong Password entered!');
        window.location.href='../login.php?user=".$user."';
        </script>";

                exit();
            } elseif($password == $dbpasswort){
              // Benutzer anmelden
              $_SESSION['session_id'] = $row['ID'];
              $_SESSION['session_user'] = $row['Email'];
              $_SESSION['session_username'] = $row['Benutzername'];
              $_SESSION['session_pwd'] = $row['Passwort'];
              $_SESSION['session_company'] = $row['Firma'];
              $_SESSION['session_lastname'] = $row['Nachname'];
              $_SESSION['session_firstname'] = $row['Vorname'];
              $_SESSION['session_street'] = $row['Straße'];
              $_SESSION['session_housenr'] = $row['Hausnummer'];
              $_SESSION['session_plz'] = $row['PLZ'];
              $_SESSION['session_ort'] = $row['Ort'];
              $_SESSION['session_tel'] = $row['Telefonnummer'];
              $_SESSION['last_login_timestamp'] = time();
              $update = "UPDATE tbl_contacts SET letzterLogin ='$date' WHERE Email = '$user'";
              mysqli_query($db_link, $update);

              if(isset($_SESSION['last_page'])){
                  if(($_SESSION['last_page'] == 'http://foodsaver.bplaced.net/registrierung.php') or ($_SESSION['last_page'] == 'http://foodsaver.bplaced.net/login.php') ){
                    header('Location: ../index.php');
                  }
                  else{
                      
                    header('Location: '. $_SESSION['last_page']);
                  }
                
                
              }
              if(!isset($_SESSION['last_page'])){
                header('Location: ../index.php');
                
              }
              
              exit();
            }
        }
    }

} else {
    header("Location: ../login.php?login=error");
    exit();
}

?>