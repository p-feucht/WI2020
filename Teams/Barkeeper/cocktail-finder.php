<?php
require($_SERVER["DOCUMENT_ROOT"].'/database/ingredients.php');
$ingredientsFactory = new Ingredients();
$ingredients = $ingredientsFactory->findAll();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkeeper | Cocktail finden</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-select.min.css">
</head>

<body>
    <?php
    include($_SERVER["DOCUMENT_ROOT"]."/includes/header.php");
    ?>
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1>Cocktail - Finder</h1>
                <p class="lead">
                    Gib hier deine Lebensmittel ein und wir suchen die passenden Cocktails für dich heraus.
                </P>
            </div>
        </section>

        <div class="py-5">
            <div class="container">
                <form id="ingredients-form" method="POST" action="/cocktail-results.php">
                    <div class="form-group row ingredient-select-group" id="ingredient-select-group-0">
                        <label for="ingredient-select-0" class="col-sm-2 col-form-label">Zutat 1</label>
                        <div class="col-sm-10">
                            <select id="ingredient-select-0" data-id="0" name="ingredient-select-0" class="form-control ingredient-select selectpicker" data-live-search="true" title="Zutat auswählen...">
                                <?php
                                    foreach ($ingredients as $key => $ingredient) {
                                        echo '<option data-tokens="' . $ingredient->getTitle() . '" value="' . $ingredient->getId() . '">' . $ingredient->getTitle() . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="add-ingredient-filter-group">
                        <button class="btn btn-block btn-outline-primary" id="add-ingredient-filter-btn"><i class="fas fa-plus"></i> Weitere Zutat hinzufügen</button>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="all-ingredients-required" name="all-ingredients-required" checked>
                            <label class="custom-control-label" id="all-ingredients-required" for="all-ingredients-required">Alle Zutaten sollen enthalten sein</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Passende Cocktails finden...</button>
                </form>
            </div>
        </div>

    </main>
    <?php
    include($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
    ?>
    <script>
        // Hässlicher Workaround
        // Da wir ja dynamisch die Anzahl der Zutaten-Auswahl-Felder anpassen wollen, müssen wir im JavaScript 
        // die verfügbaren Zutaten zur Hand haben. Der untere Code erzeugt ein Array mit Objekten folgender Struktur:
        // {id: ZutatenID, title: Titel der Zutat}
        // So muss man nicht bei jeder neuen Zutat die Seite neuladen.
        availableIngredients = [
            <?php
                foreach ($ingredients as $key => $ingredient) {
                    echo '{id: '. $ingredient->getId() .', title: "'. $ingredient->getTitle() .'"},';
                }
            ?>
        ];
    </script>
    <script src="/assets/js/bootstrap-select.min.js"></script>
    <script src="/assets/js/cocktail-finder.js"></script>
</body>

</html>