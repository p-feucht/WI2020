<?php
$servername = "localhost";
$username = "barkeeper_dbuser";
$password = "JcNgS55uY2jQJK4a";
$dbname = "barkeeper_cocktails";

// Create connection
$dbConnection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}