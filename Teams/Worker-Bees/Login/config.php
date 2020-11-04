<?php
/* Database credentials. */
/* define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'workerbees_db1'); */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "workerbees_db1";
 
/* Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} */

/* Attempt to connect to MySQL database */
$link = mysqli_connect($servername, $username, $password, $dbname);
 
/* Check connection */
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>