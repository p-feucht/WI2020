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
    <div class="rezepte">
        <p>Suchst du einen bestimmten Cocktail?  
            <form action = "/php/actionPage.php" method = "Post" id ="Input_Ingredients"> 
                <input type="text" name="" value="">  <input type="submit" value="Suchen">
            </form>
        <div class="cocktail_list">
            <div class="cocktail_card">
                <img src="images/Tages_Cocktail.jpg" style="width:100%"> 
                <div class= "cocktail_container">
                    <h3> Ein Cocktail </h3>
                    <p> X Zutaten </p>
                </div>
            </div>

            <div class="cocktail_card">
                <img src="images/Tages_Cocktail.jpg" style="width:100%"> 
                <div class= "cocktail_container">
                    <h3> Ein Cocktail </h3>
                    <p> X Zutaten </p>
                </div>
            </div>

            <div class="cocktail_card">
                <img src="images/Tages_Cocktail.jpg" style="width:100%"> 
                <div class= "cocktail_container">
                    <h3> Ein Cocktail </h3>
                    <p> X Zutaten </p>
                </div>
            </div>
        </div>     
    </div>
    <footer>
    <?php
            include("php/aboutUs.php");
        ?>
    </footer>
</body>
