<?php
/* Database localhost. */
/* define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'workerbees_db1'); */

/* database info for bplaced */
$dbservername = "localhost";
$dbusername = "workerbees_ftpuser";
$dbpassword = "HKS101";
$dbname = "workerbees_db1";
 

/* Attempt to connect to MySQL database */
$link = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
 
/* Check connection */
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>