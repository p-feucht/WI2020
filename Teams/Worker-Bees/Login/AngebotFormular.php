<?php
$pdo = new PDO('mysql:host=localhost;dbname=workerbees_db1;charset=utf8', 'workerbees_ftpuser', 'HKS101');
?>


<?php
$pagename = $_GET['pagename'];
$url = $_GET['url'];

echo '<a href="' . url . '">' . pagename . '</a>';
?>