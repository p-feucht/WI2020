<?php
$servername = "localhost";
$dbname = "barkeeper";
$username = "root";
$password = "";

// Create connection
$dbConnection = new mysqli($servername, $username, $password, $dbname);
echo $dbConnection->connect_error;
// Check connection
if ($dbConnection->connect_error) {
  die("Connection failed: " . $dbConnection->connect_error);
  echo "Connection failed: " . $dbConnection->connect_error;
}
