<?php

session_start();
unset($_SESSION["loggedIn"]);
unset($_SESSION["user"]);
session_destroy();
header("Location: /admin/login.php");
exit();

?>