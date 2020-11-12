<?php
/* Database credentials. */
/* define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'workerbees_db1'); */

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "workerbees_db1";

// port number für localhost phpmyadmin? 3306
/* $dbservername = "localhost";
$dbusername = "workerbees_ftpuser";
$dbpassword = "HKS101";
$dbname = "workerbees_db1"; */
 
/* Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} */

/* Attempt to connect to MySQL database */
$link = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
 
/* Check connection */
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
    /* else {
        echo "Connected successfully";
        echo "<br>";
    
} */

?>