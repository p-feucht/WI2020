<!DOCTYPE html>
<head>
    <meta charset = "utf-8">
    <title>Barkeeper | Tipps und Tricks</title>
    <link  href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <nav>
        <?php 
            include("php/menu.php");
        ?>
    </nav>
    <div class="content">
        <p>Da wir alle erstmal lernen müssen wie man denn den perfekten Cocktail von zu Hause aus mixt,
         hier mal ein paar unserer Tipps und Tricks mit welchen es auf jeden Fall klappt</p>
        <p>Und mach dir keine Sorge - Übung macht den Meister!</p>
    <div id="receipeContainer">
        <h1>Tipp 1: </h1>
        <p>Zum Cocktails mixen eignet sich natürlich am Besten ein sogenannter Cocktail Shaker.
            Den findest du in jedem Haushaltswarengeschäft oder auf Amazon, Ebay etc. Aber diesen richtig zu benutzen ist gar nicht so einfach,
            deswegen haben wir hier ein kleines Tutorial für dich herausgesucht:</p>
        <iframe width="373" height="210" src="https://www.youtube.com/embed/AUAJE4UrZbE" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>Und solltest du noch einen Shaker gebrauchen, haben wir auch schon einen passenden für dich gefunden:</p>
       <p><a href="https://www.barstuff.de/barzubehoer-cocktail-sets/bar-aid-set-classic-home.html">Dein Cocktail Shaker</a></p>
            <p>Hat dir der Trick gefallen? <button type="button" id="Gefällt"><img src="images/Trick.jpg"></button>
             <button type="button" id="GefälltNicht"><img src="images/Eingabe.jpg"></button></p>
    </div>
    <div id="receipeContainer">
        <h1>Tipp 2:</h1>
        <p>Cocktails sollten nicht warm serviert werden, deswegen schau darauf, dass auch dein Cocktail Glas schön kühl ist.
            Stelle es entweder ein paar Minuten vorher in den Kühlschrank oder gib schon zu Beginn Eis hinein.</p>
            <p>Hat dir der Trick gefallen? <button type="button" id="Gefällt"><img src="images/Trick.jpg"></button>
             <button type="button" id="GefälltNicht"><img src="images/Eingabe.jpg"></button></p>
    </div>
    <div id="receipeContainer">
        <h1>Tipp 3:</h1>
        <p>Man sagt nicht umsonst das Auge trinkt mit, deshalb solltest du auch auf das Äußere deines Cocktails achten.
            Das geht ganz leicht, in dem du entweder eine Frucht schön aufschneidest und an den Glasrand steckst, oder in 
            dem du etwas "Grünzeug" wie Minze auf den Cocktail legst</p>
            <p>Hat dir der Trick gefallen? <button type="button" id="Gefällt"><img src="images/Trick.jpg"></button>
             <button type="button" id="GefälltNicht"><img src="images/Eingabe.jpg"></button></p>
    </div>   
    </div>
    <footer>
        <?php
            include("php/aboutUs.php");
        ?>
    </footer>
</body>