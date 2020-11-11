<?php
session_start();
if(isset($_SESSION['session_username'])){
   session_unset();
   session_destroy();
   header('Location: ../index.html');
   exit();
}
?>