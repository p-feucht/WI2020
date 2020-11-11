<?php
// Initialize the session
/* session_start(); */
 
// Check if the user is already logged in, if yes then redirect him to welcome page
/* if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: indexTest.php");
    exit;
} */
 
// Include config file
require_once "Login/config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Benutzername eingeben.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Passwort eingeben.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM user where username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
           /*  $hashed_password = mysqli_query($link, "SELECT password FROM user where username = $username");
            echo $hashed_password; */
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables

                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    /* echo $username;
                    echo ' ,'; 
                    echo $hashed_password;
                    echo ' ,'; 
                    echo $password; */
                   

                    if(mysqli_stmt_fetch($stmt)){
                        
                        
                        /* echo "fehler";
                        echo $hashed_password;
                        echo " ,"; */
                        $sql_2 = "SELECT password FROM user where username = '$username'";
                        $password_query = mysqli_query($link, $sql_2);
                        $password_result = mysqli_fetch_assoc($password_query);
                        $hashed_password = $password_result['password'];
                        /* echo $hashed_password; */


                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: indexTest.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Das eingegebene Passwort ist falsch.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "Der eingegebene Benutzername ist falsch.";
                }
            } else{
                echo "Oops! Bitte erneut versuchen.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="CSS/loginDesign.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; margin: 0 auto; }
    </style>
</head>
<body>
<?php include "PHP/header.php";?>
    <div class="wrapper">
        <h2>Anmelden</h2>
        <p>Bitte gebe deine Daten ein, um dich einzuloggen.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Benutzername</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Passwort</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Anmelden">
            </div>
            <p>Du hast noch keinen Account? 
            </br> 
            <a href="register.php">Hier kannst Du dich registrieren.</a></p>
        </form>
    </div>   
</body>
</html>