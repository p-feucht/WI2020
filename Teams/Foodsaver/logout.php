<?php
session_start();
session_unset();
session_destroy();
$_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];
if(isset($_SESSION['last_page'])){
header('Location: '. $_SESSION['last_page']);
}
else{
    header('Location: ../index.php');
}


?>