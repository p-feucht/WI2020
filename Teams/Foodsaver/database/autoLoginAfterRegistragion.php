<?php



if (isset($_SESSION['session_user']) and isset($_SESSION['session_pwd'])) {

    require("connectDB.php");

    $user = $_SESSION['session_user'];
    $password = $_SESSION['session_pwd'];
    $date = date("Y-m-d H:i:s");

    $sql = "SELECT * FROM tbl_contacts WHERE Email = '$user'";
    $result = mysqli_query($db_link, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
        echo "<script>
        alert('No User found for entered Email!');
        window.location.href='../login.php?email=".$user."';
        </script>";
        exit();
    } else {
        if ($row = mysqli_fetch_assoc($result)) {
            
            $dbpasswort = $row['Passwort'];
            if ($password != $dbpasswort) {
              echo "<script>
              alert('Wrong Password entered!');
        window.location.href='../login.php';
        </script>";
                exit();
            } elseif($password == $dbpasswort){

              $_SESSION['last_login_timestamp'] = $date;
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