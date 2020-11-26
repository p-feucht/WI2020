<?php
session_start();
if($_SESSION["loggedIn"] !== true){
    header("Location: /admin/login.php");
    exit();
}
require($_SERVER["DOCUMENT_ROOT"]."/database/models/cocktail.php");
    $cocktail = new Cocktail();
    if($_GET["unpublish"] == "true"){
        $cocktail->unpublish($_GET["id"]);
    }
    if($_GET["unpublish"] == "false"){
        $cocktail->publish($_GET["id"]);
    }
    header("Location: /admin/cocktails.php");
?>