<?php
// connection mit Datenbank aufbauen
$db_link = mysqli_connect('localhost', 'foodsaver', 'toogoodtowaste', 'foodsaver_db');

if (!$db_link) {

    die('<p>Verbindung nicht hergestellt!</p>');
}


$db_link->set_charset("utf8");
