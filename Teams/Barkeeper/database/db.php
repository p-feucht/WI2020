<?php
$servername = "barkeeper.bplaced.net";
$dbname = "barkeeper_cocktails";
$username = "barkeeper_dbuser";
$password = "JcNgS55uY2jQJK4a";

// Create connection
$dbConnection = new mysqli($servername, $username, $password, $dbname);
echo $dbConnection->connect_error;
// Check connection
if ($dbConnection->connect_error) {
  die("Connection failed: " . $dbConnection->connect_error);
  echo "Connection failed: " . $dbConnection->connect_error;
}
