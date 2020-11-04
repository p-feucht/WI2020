<?php
session_start();
?>

<!doctype html>

<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Too Good to Waste</title>
    <meta name="description" content="Webseite zur Vermeidung von Lebensmittelverschwendung">
    <link href="Metadaten/design.css" rel="stylesheet">
    <link href="Metadaten/index.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="autologout.js"></script>
    <script src="RecordsDropdown.js" type="text/javascript"></script>

</head>

<body>

    <?php
        require("Metadaten/chooseHeader.php");
    ?>
   
    <!--div id="homepage_image">
        <img id="homepage_image_Bild" src="Pictures/homepage_image_small.jpg" alt="Food" style="width:100%">
    </div-->

    <?php
        if(isset($_SESSION['session_username'])){
            $imageCount = 2;
        }
        else{
            $imageCount = 1;
        }
    ?>

    <script>
    
    var image = document.images[<?php echo($imageCount);?>]
    var bigImage = document.createElement("img")

    bigImage.onload = function(){

        image.src = this.src
    }
    setTimeout(function(){
        bigImage.src = "Pictures/homepage_image.jpg";
    }, 50)
    

    </script>


    <div id="homepage_headline">
        <p> Be a Foodsaver! <p>
    </div>

    <div id="homepage_text">
        <p> Willkommen zu unserer Webseite! Hier werden übrig gebliebene Mahlzeiten und Lebensmittel angeboten, die noch vom selben Tag stammen. Dabei werden diese von den verschiedensten Anbietern bereitgestellt: Restaurants in deiner Stadt, die Bäckerei,
        von der du jeden morgen Brötchen holst oder sogar vielleicht die nette Nachbarin neben dir! Also schau gern mal durch und bestelle etwas. Dabei sparst du nicht nur Geld, sondern hilfst vor allem auch der Umwelt! </p>
    </div>

    <div class="homepage_main">
        <aside>
            <p> Filter <p>

            <div class="filter_dropdown">
            <form action="/action_page.php">
                    <select name="categorie" id="categorie">
                        <option value="" disabled selected>Kategorie</option>
                        <option value="Bäckerei">Bäckerei</option>
                        <option value="Imbiss">Imbiss</option>
                        <option value="Private_Haushalte">Private Haushalte</option>
                        <option value="Restaurant">Restaurant</option>
                        <option value="Supermarkt">Supermarkt</option>
                        <option value="Sonstige">Sonstige</option>
                    </select>
                </form>

                <form action="/action_page.php">
                    <select name="kitchen" id="kitchen">
                        <option value="" disabled selected>Küche</option>
                        <option value="Chinesisch">Chinesisch</option>
                        <option value="Französisch">Französisch</option>
                        <option value="Griechisch">Griechisch</option>
                        <option value="Italienisch">Italienisch</option>
                        <option value="Mexikanisch">Mexikanisch</option>
                        <option value="Türkisch">Türkisch</option>
                        <option value="Deutsch">Deutsch</option>
                        <option value="Sonstige">Sonstige</option>
                    </select>
                </form>

                <form action="/action_page.php">
                    <select name="price" id="price">
                        <option value="" disabled selected>Preis</option>
                        <option value="under5euros">Unter 5€</option>
                        <option value="5until10euros">5€ - 10€</option>
                        <option value="5until15euros">10€ - 20€</option>
                        <option value="5until15euros">Über 20€</option>
                    </select>
                </form>

                <form action="/action_page.php">
                    <select name="distance" id="distance">
                        <option value="" disabled selected>Entfernung</option>
                        <option value="until1km">bis zu 1 km</option>
                        <option value="until5lm">bis zu 5 km</option>
                        <option value="until10km">bis zu 10 km</option>
                    </select>
                </form>
            </div>

            <div class="filter_button">
                <button type="button" id="apply_filter">Apply Filter</button>
                <button type="button" id="reset_filter">Reset Filter</button>
            </div>
        </aside>

        <main>
            <form id="search-form" action="" method="POST">
                <input type="text" id="myInput" name="myInput" placeholder="Suchst du etwas bestimmtes?">            
                <button id="searchButton" name="searchButton">Suchen</button>
            </form>

            <?php
            
                require('database/Records_Abfrage.php');
            ?>  
        </main>
    </div>

    <?php
    require("Metadaten/footer.php");
    ?>
</body>

</html>

