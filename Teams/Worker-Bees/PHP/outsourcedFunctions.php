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

// this function returns the workshop equipment in textual form
function tellEquipment($abohr, $adrechsel, $aschleif, $asaege, $akleinteil){
    $equipment="";
    if ($abohr=="ja"){
        $equipment = $equipment ."Standbohrmaschine ";
    }
    if ($adrechsel=="ja"){
        $equipment .= "Drechselbank/Drehbank ";
    }
    if ($aschleif=="ja"){
        $equipment .= "Schleifmaschine ";
    }
    if ($asaege=="ja"){
        $equipment .= "elektriche Standsäge ";
    }
    if ($akleinteil=="ja"){
        $equipment .= "Grundausstattung Kleinteile ";
    }if ($akleinteil!="ja" && $adrechsel!="ja" && $aschleif!="ja" && $asaege!="ja" && $akleinteil!="ja"){
        $equipment = "keine Ausstattungsmerkmale genannt";
    }
    return $equipment;  
}

?>