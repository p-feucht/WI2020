<!DOCTYPE html>
<head>
    <meta charset = "utf-8">
    <title>Barkeeper | Eingabe der Zutaten</title>
    <link  href="../style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <nav>
        <img src="../images/Logo.png" alt="Barkeeper Logo" id="logo"/>
        <h1>Eingabe der Zutaten</h1>
        <?php 
            include("menu.php");
        ?>
    </nav>
    <p>Eingabe der Zutaten</p>
    <form>
        <label for="Alkohol"> Alkohol: </label> <br>
        <input type="text" id= "Alkohol1" name="Zutat1">
        <input type="text" id= "Alkohol2" name="Zutat2"> <br>
        <label for= "Säfte"> Säfte: </label> <br>
        <input type="text" id= "Saft1" name="Saft1"> 
        <input type="text" id= "Saft2" name="Saft2"> <br>
        <label for= "Grünzeug"> Grünzeug</label> <br>
        <input type="text" id= "Grünzeug1" name="Grünzeug1">
        <input type="text" id= "Grünzeug1" name="Grünzeug1">  <br>
        <input type="submit" value="Submit">
    </form>
    <footer>
    <?php
            include("aboutUs.php");
        ?>
    </footer>
</body>