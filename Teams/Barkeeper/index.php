<!DOCTYPE html>
<head>
    <meta charset = "utf-8">
    <title>Barkeeper</title>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <nav>
        <?php 
            include("php/menu.php");
        ?>
    </nav>
    <div class="content">
        <p>Mithilfe von uns Barkeepern kannst du deinen Cocktail mixen ohne extra einkaufen gehen zu müssen. Somit musst du deine Reste nicht wegschütten und sparst dir Geld für deinen nächsten Einkauf.</p>
        <p>Du gibst einfach ein, was du noch zuhause hast, und schon kann die Party losgehen. Aber bei uns kannst du nicht nur deine "Reste verwerten"</p>
        <p>Wir liefern dir auch die leckersten Cocktailrezepte, sowie Tipps und Tricks wie die dein perfekter Cocktail gelingt.</p>
        <p>Hast du ein eigenes Cocktail Rezept welches du unbedingt mit der Welt teilen willst? Dann teile dein Rezept <a href="rezeptidee.php">hier</a> mit uns</p>
        <img src="images/Tages_Cocktail.jpg" alt="Unser Cocktail des Tages"
            width="300"
            height="300"/>
        <p>Für den CAIPIRINHA brauchst du Folgendes</p>
        <table class="ingredients">
            <tr>
                <th>Ztaten</th>
                <th>Menge</th>
            </tr>
            <tr>
                <td>Cachaca (Pitù)</td>
                <td>6cl</td>
            </tr>
            <tr>
                <td>Limette</td>
                <td>1 Stück</td>
            </tr>
            <tr>
                <td>Rohrzucker</td>
                <td>2 EL</td>
            </tr>
            <tr>
                <td>Crushed Ice</td>
                <td>4 EL</td>
            </tr>
        </table>
        <p>Vorgehensweise:
            Die beiden Limettenenden der unbehandelten Limetten abschneiden, achteln und in ein Tumbler-Glas 
            geben. Den braunen Zucker drüber verteilen und die Limettenstücke mit einem Stößel ausdrücken.
            Zum Schluss Cachaca dazugeben. Das Glas mit Crushed Ice auffüllen und alles gut durchrühren. 
            Eventuell noch einen Schuss Soadwasser hinzufügen und den Cocktail mit einem Trinkhalm servieren.
        </p>
        <p>Und fertig ist dein CAIPIRINHA</p>
    </div>
    <footer>
    <?php
        include("php/aboutUs.php");
    ?>
    </footer>
</body>