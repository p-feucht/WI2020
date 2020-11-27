<?php
//Logged User aus, zerstört die Session und leitet ihn zur Startseite weiter
session_start();
session_unset();
session_destroy();
header('Location: ../index.php');
