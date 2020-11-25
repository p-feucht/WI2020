<?php
require($_SERVER["DOCUMENT_ROOT"]."/database/cocktails.php");
require($_SERVER["DOCUMENT_ROOT"]."/database/ingredients.php");
$cocktailsFactory = new Cocktails();
$id = $_GET["id"];
$cocktail = $cocktailsFactory->findById($id);
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>

<body>
    <?php
    include($_SERVER["DOCUMENT_ROOT"]."/includes/header.php");
    ?>
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1><?php echo $cocktail->getTitle(); ?></h1>
                <p class="lead">
                    <?php echo $cocktail->getDescription(); ?>
                </P>
                <p class="mb-0">
                    <?php echo '<img style="max-height: 400px;" src="/assets/images/cocktails/' . $cocktail->getImage() . '">' ?>
                </p>
            </div>
        </section>
        <div class="py-">
            <div class="container">
                <h3>Zutaten:</h3>
                <?php
                    $ingredients = $cocktail->getIngredients();
                    // print_r(count($ingredients));
                    foreach ($ingredients as $ingredient) {
                        echo '<div class="row">';
                            echo '<div class="col-md-2">' . $ingredient->getAmount() . "</div>";
                            echo '<div class="col-md-10">' . $ingredient->getTitle() . "</div>";
                        echo "</div>";
                    }
                ?>
                <h3 class="mt-5">Zubereitung:</h3>
                <div class="row">
                    <div class="col-md-12">
                        <p><?php $cocktail->getPreparation() ?></p>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php
    include($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
    ?>
</body>

</html>