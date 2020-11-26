<?php
    require($_SERVER["DOCUMENT_ROOT"]."/database/cocktails.php");
    $cocktailsFactory = new Cocktails();
    $cocktails = $cocktailsFactory->findAll();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkeeper | Home</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>

<body>
    <?php
        include($_SERVER["DOCUMENT_ROOT"]."/includes/header.php");
    ?>
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1>Willkommen auf Barkeeper</h1>
                <p class="lead">
                    Mithilfe von uns Barkeepern kannst du deinen Cocktail mixen ohne extra einkaufen gehen zu müssen. Somit musst du deine Reste nicht 
                    wegschütten und sparst dir Geld für deinen nächsten Einkauf. Du gibst einfach ein, was du noch zuhause hast, und schon kann die Party 
                    losgehen. Aber bei uns kannst du nicht nur deine "Reste verwerten". Wir liefern dir auch die leckersten Cocktailrezepte, sowie Tipps 
                    und Tricks wie dir dein perfekter Cocktail super schnell gelingt.
                </P>
                <p class="lead">
                    Hast du ein eigenes Cocktail Rezept welches du unbedingt mit der Welt teilen willst?
                </p>
                <p class="mb-0">
                    <a href="/own-recipe.php" class="btn btn-secondary my-2">Erstelle dein eigenes Rezept</a>
                </p>
            </div>
        </section>
        <div class="py-5">
            <div class="container">
                <h2>Beliebte Cocktails</h2>
                <div class="row">
                    <?php
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