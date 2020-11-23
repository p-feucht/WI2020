<?php

// IF-Abfrage, damit kein Inhalt angezeigt wird, 
// wenn ein User die URL errät
if (isset($_POST['submit'])) {

// Hier laden wir unsere Verbindung zur Datenbank
  include_once 'db.php';

// mysqli_real_escape_string sorgt dafür, dass nur Text, 
// aber kein Code in die Datenbank kommt
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $password1 = mysqli_real_escape_string($connection, $_POST['password1']);
  $password2 = mysqli_real_escape_string($connection, $_POST['password2']);
  $error = false;

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo('Bitte eine gültige E-Mail-Adresse eingeben<br>');
    $error = true;
}     
if(strlen($password1) < 6) {
    echo('Bitte ein Passwort mit mindestens 6 Zeichen angeben<br>');
    $error = true;
}
if($password1 != $password2) {
    echo('Die Passwörter müssen übereinstimmen<br>');
    $error = true;
}

//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
if(!$error) { 
    $statement = $connection->prepare("SELECT * FROM accounts WHERE Email = '$email'");
    $statement->execute();
    $result = $statement->get_result();
    $count = $result->num_rows;
    
    if($count >=1) {
        echo('Diese E-Mail-Adresse ist bereits vergeben<br>');
        $error = true;
    }    
}

//Überprüfe, dass der Username noch nicht registriert wurde
if(!$error) { 
    $statement = $connection->prepare("SELECT * FROM accounts WHERE Username = '$username'");
    $statement->execute();
    $result = $statement->get_result();
    $count = $result->num_rows;
        
    if($count >=1) {
        echo('Der Benutzername ist bereits vergeben<br>');
        $error = true;
    }    
}

if(!$error){
    // Passwort verschlüsseln
    $hashPassword = password_hash($password1,PASSWORD_DEFAULT);
  
    // Jetzt wird der Nutzer in die Datenbank übertragen
    $sql = "INSERT INTO accounts VALUES ('$email', '$username', '$hashPassword');";
    mysqli_query($connection, $sql);
    // Der User wird bei einem erfolgreichen Prozess auf die Startseite geschickt
    header('Location: ../index.php');
    exit();
}

} else {
// Falls jemand die URL erraten hat, wird er durch
// das else zum Registrierungsformular geschickt
    header('Location: ../index.php');
    exit();
}

?>