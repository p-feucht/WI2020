<?php
//wird ausgeführt, wenn User aufgrund von inaktivität abgemeldet wird
//Logged User aus, zerstört die Session und leitet ihn zur Startseite weiter
//Teilt user noch mit, dass er zu lange inaktiv war
session_start();
session_unset();
session_destroy();
echo ("<script>alert('Session abgelaufen. Bitte loggen Sie sich erneut ein!');
window.location.href='../index.php';</script>");
