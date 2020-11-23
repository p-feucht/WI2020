<?php
    require($_SERVER["DOCUMENT_ROOT"].'/database/tipps.php');
    $tippsFactory = new Tipps();
    $tipps = $tippsFactory->findAll();
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
                <h1>Tipps & Tricks</h1>
                <p class="lead">
                    Da wir alle erstmal lernen müssen wie man denn den perfekten Cocktail von zu Hause aus mixt,
                    hier mal ein paar unserer Tipps und Tricks mit welchen es auf jeden Fall klappt
                </P>
                <p class="lead">
                    Und mach dir keine Sorge - Übung macht den Meister!
                </p>
            </div>
        </section>

        <div class="py-5">
            <div class="container">
                <div class="row">
                    <?php
                        foreach ($tipps as $tipp) {
                            echo '<div class="col-md-12">
                                <div class="card border-light mb-4 ">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            ' . $tipp->getTitle() . '
                                        </h4>
                                        <p class="card-text">' . $tipp->getContent() . '</p>
                                        <p>Hat dir der Trick gefallen? Dann gib uns dein Like</p>
                                    </div>
                                    <div class="card-footer bg-transparent text-muted">
                                        <button class="btn btn-outline-primary like-tip-btn" data-id="' . $tipp->getId() . '">
                                                <i class="far fa-thumbs-up" data-id="' . $tipp->getId() . '"></i>
                                        </button> 
                                        <span class="float-right" id="likes-counter-' . $tipp->getId() . '">' . $tipp->getLikes() . ' Likes</span>
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
    <script src="/assets/js/tipps.js"></script>
</body>

</html>