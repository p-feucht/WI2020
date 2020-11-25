<?php

//function that connects to the dataBase
function createConnToDB (){
    //Connection to bplaced server
    $servername = "localhost";
    $username = "workerbees";
    $password = "HKSZ52";
    $dbname = "workerbees_db1";

    // Create connection
    $connP = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($connP->connect_error) {
        $connP="";
      //  die("Connection failed: " . $connP->connect_error);
    }
    return $connP;
}

// the data-table stores the result of ckeckboxes as "1" for ckecked and "0" for unckecked. This function is used to translate the binary information into 
function translateBoolFromDB ($aBinary){
    if($aBinary==1){
        return "ja";

    } else{
        return "nein";
    }
}

?>