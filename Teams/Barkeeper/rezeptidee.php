<!DOCTYPE html>
<head>
    <meta charset = "utf-8">
    <title>Barkeeper | Rezeptidee</title>
    <link  href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <nav> 
        <?php 
            include("php/menu.php");
        ?>
    </nav>
    <div class="content">
        <p> Du findest deinen Lieblingscocktail bei uns nicht? Dann teile uns das Rezept über folgendes Formular mit. </p>
        <form action = "/php/yourOwnReceiptIdea.php" method = "Post" id ="Input_Ingredients">
            <input 
                type="text" name="CocktailName" placeholder = "Cocktail Name" 
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Cocktail Name'" 
            />
            <input 
                type="text" name="Beschreibung" placeholder = "Kurze Beschreibung" 
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='KurzeBeschreibung'" 
            />
            <br>
            <input 
                type="text" name="Alkohol1" placeholder = "Alkohol" 
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Alkohol'" 
            />
            <input 
                type="text" name="Alkohol1Menge" placeholder = "Menge" 
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Menge'" 
            />
            <br>
            <input 
                type="text" name="Alkohol2" placeholder="Alkohol"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Alkohol'" 
            >
            <input 
                type="text" name="Alkohol2Menge" placeholder = "Menge" 
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Menge'" 
            />
            <br>
            <input 
                type="text" name="Saft1" placeholder="Saft"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Saft'" 
            > 
            <input 
                type="text" name="Saft1Menge" placeholder = "Menge" 
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Menge'" 
            />
            <br>
            <input 
                type="text" name="Saft2" placeholder="Saft"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Saft'" 
            > 
            <input 
                type="text" name="Saft2Menge" placeholder = "Menge" 
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Menge'" 
            />
            <br>
            <input 
                type="text" name="Grünzeug1" placeholder="Grünzeug"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Grünzeug'" 
            >
            <input 
                type="text" name="Grünzeug1Menge" placeholder="Menge"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Menge'" 
            >
            <br>
            <input 
                type="text" name="Grünzeug2" placeholder="Grünzeug"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Grünzeug'" 
            >
            <input 
                type="text" name="Grünzeug2Menge" placeholder="Menge"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Menge'" 
            >
            <br>
            <input 
                type="submit" value="Absenden"
            >
        </form>
    </div>
    <footer>
    <?php
            include("php/aboutUs.php");
        ?>
    </footer>
</body>