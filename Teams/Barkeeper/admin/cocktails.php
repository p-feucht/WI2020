<?php
    
    session_start();
    if($_SESSION["loggedIn"] !== true){
        header("Location: /admin/login.php");
        exit();
    }

    require($_SERVER["DOCUMENT_ROOT"]."/database/cocktails.php");
    $cocktailsFactory = new Cocktails();
    $cocktails = $cocktailsFactory->findAll(false);
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
        include($_SERVER["DOCUMENT_ROOT"]."/includes/header-admin.php");
    ?>
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1>Administration</h1>
                <h2>Cocktails</h2>
            </div>
        </section>
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <?php
                        foreach ($cocktails as $key => $cocktail) {
                            $html = '<div class="col-md-6 col-lg-4">
                                    <div class="card mb-4 shadow-sm">
                                        <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="/assets/images/cocktails/' . $cocktail->getImage() . '">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="/admin/cocktail.php?id='.$cocktail->getId().'">' . $cocktail->getTitle() . '</a></h5>
                                            <p class="card-text">' . $cocktail->getDescription() . '</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">' . $cocktail->isAlcoholic() . '</small>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">';
                            if($cocktail->getReleased() === 1) {
                                $html = $html .'<a href="/admin/cocktail-release.php?id='.$cocktail->getId().'&unpublish=true"><button type="button" class="btn btn-danger btn-sm">Ausblenden</button></a>';
                            } else {
                                $html = $html .'<a href="/admin/cocktail-release.php?id='.$cocktail->getId().'&unpublish=false"><button type="button" class="btn btn-secondary btn-sm">Veröffentlichen</button></a>';
                            }
                            $html = $html .'</div>
                                    </div>
                                </div>';
                            echo $html;
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