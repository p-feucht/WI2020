<?php
    require($_SERVER["DOCUMENT_ROOT"]."/database/cocktails.php");
    require($_SERVER["DOCUMENT_ROOT"]."/database/ingredients.php");

    $cocktailsFactory = new Cocktails();
    $ingredientsFactory = new Ingredients();

    $ingredientIDs = [];
    $ingredients = [];
    $containAllIngredients = false;

    foreach($_POST as $key => $value) {
        if($key === "all-ingredients-required") {
            if($value === "on") {
                $containAllIngredients = true;
            } else {
                $containAllIngredients = false;
            }
        } else {
            if($value) {
                array_push($ingredientIDs, $value);
                array_push($ingredients, $ingredientsFactory->findById(intval($value)));
            }
        }
    }
    $cocktails = $cocktailsFactory->findAllWithIngredients($ingredientIDs, $containAllIngredients);
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkeeper | Suchergebnis</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>

<body>
    <?php
        include($_SERVER["DOCUMENT_ROOT"]."/includes/header.php");
    ?>
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1>Diese <?php echo (count($cocktails) > 0 ? count($cocktails) : ""); ?> Cocktails passen zu deinen Zutaten</h1>
                <p class="lead">
                    <?php
                        $ingCount = count($ingredients);
                        $i = 0;
                        foreach ($ingredients as $key => $ingredient) {
                            if(++$i === $ingCount) {
                                echo $ingredient->getTitle();
                            } else {
                                echo $ingredient->getTitle() . " " . ($containAllIngredients ? "und" : "oder") . " ";
                            }
                        }
                    ?>
                </P>
                <p class="mb-0">
                    <a href="/cocktail-finder.php" class="btn btn-secondary my-2"><i class="fas fa-arrow-left"></i> Zurück zur Zutatenauswahl</a>
                </p>
            </div>
        </section>
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <?php
                        if(count($cocktails) === 0) {
                            echo '<div class="col-md-12">
                                <div class="alert alert-primary" role="alert">
                                    <h4>Leider haben wir kein Cocktail zu deinen ausgewählten Zutaten gefunden <i class="far fa-frown float-right"></i></h4>
                                </div>
                            </div>';
                        } else {
                            foreach ($cocktails as $key => $cocktail) {
                                echo '<div class="col-md-6 col-lg-4">
                                        <div class="card mb-4 shadow-sm">
                                            <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="/assets/images/cocktails/' . $cocktail->getImage() . '">
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="/cocktail.php?id='.$cocktail->getId().'">' . $cocktail->getTitle() . '</a></h5>
                                                <p class="card-text">' . $cocktail->getDescription() . '</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">' . $cocktail->isAlcoholic() . '</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

    </main>
    <?php
        include($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
    ?>
</body>

</html>