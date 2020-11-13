<!DOCTYPE html>
<head>
    <meta charset = "utf-8">
    <title>Barkeeper | Rezepte</title>
    <link  href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <nav>
        <?php 
            include("php/menu.php");
        ?>
    </nav>
    <div class="content">
        <p>Suchst du einen bestimmten Cocktail?  
            <form action = "/php/actionPage.php" method = "Post" id ="Input_Ingredients"> 
                <input type="text" name="" value="">  <input type="submit" value="Suchen">
            </form>
        </p>
        <p>Willst du dich inspiriern lassen? Dann scroll dich doch einfach durch unsere Cocktail Rezepte:</p>
        <p>Rezept 1</p>
        <p>Rezept 2</p>
        <p>Rezept 3</p>
        <p>Rezept 4</p>
        <p>Rezept 5</p>
    </div>
    <footer>
    <?php
            include("php/aboutUs.php");
        ?>
    </footer>
</body>