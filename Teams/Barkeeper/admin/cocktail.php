<?php
    session_start();
    if($_SESSION["loggedIn"] !== true){
        header("Location: /admin/login.php");
        exit();
    }
    require($_SERVER["DOCUMENT_ROOT"]."/database/cocktails.php");
    require($_SERVER["DOCUMENT_ROOT"]."/database/ingredients.php");
    $ingredientsFactory = new Ingredients();
    $ingredients = $ingredientsFactory->findAll();
    $cocktailsFactory = new Cocktails();
    $id = $_GET["id"];
    $cocktail = $cocktailsFactory->findById($id);
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkeeper | Admin <?php $cocktail->getTitle() ?> </title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">

    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body>
    <?php
    include($_SERVER["DOCUMENT_ROOT"]."/includes/header-admin.php");
    ?>
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1>Cocktail bearbeiten</h1>
            </div>
        </section>
        <div class="py-5">
            <div class="container">
                <form action="/admin/own-result.php?id=<?php echo $id; ?>" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="title-input">Cocktail Name</label>
                            <input type="text" class="form-control" id="title-input" name="title-input" value="<?php echo $cocktail->getTitle(); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 quill-editor-container" id="description-input-fg">
                            <label for="description-input">Kurzebeschreibung</label>
                            <div id="description-input"></div>
                            <input type="text" class="form-control" id="description-text-input"  value="<?php echo $cocktail->getDescription(); ?>" name="description-input" hidden>
                        </div>
                    </div>
                    <div class="form-group row ingredient-select-group" id="ingredient-select-group-0">
                        <label for="ingredient-select-0" class="col-sm-1 col-form-label">Zutat 1</label>
                        <div class="col-sm-6">
                            <select id="ingredient-select-0" data-id="0" name="ingredient-select-0" class="form-control ingredient-select selectpicker" data-live-search="true" title="Zutat auswählen...">
                                <?php
                                    foreach ($ingredients as $key => $ingredient) {
                                        echo '<option data-tokens="' . $ingredient->getTitle() . '" value="' . $ingredient->getId() . '">' . $ingredient->getTitle() . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="ingredient-amount-0" data-id="0" name="ingredient-amount-0" placeholder="Menge">
                        </div>
                    </div>
                    <div class="form-group" id="add-ingredient-filter-group">
                        <button class="btn btn-block btn-outline-primary" id="add-ingredient-filter-btn"><i class="fas fa-plus"></i> Weitere Zutat hinzufügen</button>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 quill-editor-container" id="recipe-input-fg">
                            <label for="recipe-input">Zubereitung</label>
                            <div id="recipe-input"></div>
                            <input type="text" class="form-control" id="recipe-text-input" name="recipe-input"  value="<?php echo $cocktail->getPreparation(); ?>" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="cocktail-image-input" name="cocktail-image-input">
                            <label class="custom-file-label" for="cocktail-image-input"><?php echo $cocktail->getImage(); ?></label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success btn-block">Änderungen Speichern</button>
                        </div>
                    </div>
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
    <script src="/assets/js/ingredients-selector.js"></script>
    <script src="/assets/js/own-recipe.js"></script>
</body>

</html>