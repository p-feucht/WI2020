<!DOCTYPE html>
<head>
    <meta charset = "utf-8">
    <title>Barkeeper | Eingabe der Zutaten</title>
    <link  href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <nav>
        <?php 
            include("php/menu.php");
        ?>
    </nav>
    <div class="content">
        <p> Gib hier deine Lebensmittel ein und wir suchen die passenden Cocktails für dich heraus. </p>
        <form action = "/php/actionPage.php" method = "Post" id ="Input_Ingredients">
            <input 
                type="text" id= "Alkohol1" name="Zutat1" placeholder = "Alkohol" 
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Alkohol'" 
            />
            <input 
                type="text" id= "Alkohol2" name="Zutat2" placeholder="Alkohol"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Alkohol'" 
            > <br>
            <input 
                type="text" id= "Saft1" name="Saft1" placeholder="Saft"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Saft'" 
            > 
            <input 
                type="text" id= "Saft2" name="Saft2" placeholder="Saft"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Saft'" 
            > <br>
            <input 
                type="text" id= "Grünzeug1" name="Grünzeug1" placeholder="Grünzeug"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Grünzeug'" 
            >
            <input 
                type="text" id= "Grünzeug1" name="Grünzeug1" placeholder="Grünzeug"
                onfocus="this.placeholder=''" 
                onblur="this.placeholder='Grünzeug'" 
            >  <br>
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