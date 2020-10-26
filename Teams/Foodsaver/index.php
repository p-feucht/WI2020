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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="autologout.js"></script>
    <script src="RecordsDropdown.js" type="text/javascript"></script>
</head>

<body>

    <?php
        require("Metadaten/chooseHeader.php");
    ?>
    

    <header>
        <p>Too Good to Waste</p>
    </header>

    <section>
        <p> Willkommen zu unserer Webseite! Hier werden übrig gebliebene Mahlzeiten und Lebensmittel angeboten, die noch vom selben Tag stammen. Dabei werden diese von den verschiedensten Anbietern bereitgestellt: Restaurants in deiner Stadt, die Bäckerei,
            von der du jeden morgen Brötchen holst oder sogar vielleicht die nette Nachbarin neben dir! Also schau gern mal durch und bestelle etwas. Dabei sparst du nicht nur Geld, sondern hilfst vor allem auch der Umwelt!
        </p>
    </section>

    <aside>
        <div id="Filter">
            <p> Filter <p>

            <form action="/action_page.php">
                <!--label for="categorie">Kategorie:</label-->
                <select name="categorie" id="categorie">
                    <option value="" disabled selected>Kategorie</option>
                    <option value="Asiatisch">Asiatisch</option>
                    <option value="Europäisch">Europäisch</option>
                    <option value="Amerikanisch">Amerikanisch</option>
                </select>
            </form>

            <form action="/action_page.php">
                <!--label for="price">Preis:</label-->
                <select name="price" id="price">
                    <option value="" disabled selected>Preis</option>
                    <option value="under5euros">Unter 5€</option>
                    <option value="5until10euros">5€ - 10€</option>
                    <option value="5until15euros">10€ - 20€</option>
                    <option value="5until15euros">Über 20€</option>
                </select>
            </form>

            <form action="/action_page.php">
                <!--label for="distance">Entfernung:</label-->
                <select name="distance" id="distance">
                    <option value="" disabled selected>Entfernung</option>
                    <option value="until1km">bis zu 1 km</option>
                    <option value="until5lm">bis zu 5 km</option>
                    <option value="until10km">bis zu 10 km</option>
                </select>
            </form>

            <button type="button">
                <span>Apply Filter</span>
            </button>

            <button type="button">
                <span>Reset Filter</span>
            </button>
        </div>
    </aside>

    <main>
        <form id="search-form" action="" method="POST">
            <input type="text" id="myInput" name="myInput" placeholder="Suchst du etwas bestimmtes?">            
            <button id="searchButton" name="searchButton">suchen</button>
        </form>

        <?php
            require('database/Records_Abfrage.php');
        ?>  
    </main>

    <?php
    require("Metadaten/footer.php");
    ?>
</body>

</html>