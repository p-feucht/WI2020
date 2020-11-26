<?php
    
    session_start();
    if($_SESSION["loggedIn"] !== true){
        header("Location: /admin/login.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        require($_SERVER["DOCUMENT_ROOT"]."/database/models/ingredient.php");
        $ingredient = new Ingredient();
        $ingredient->setId($_GET["id"]);
        $ingredient->delete();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require($_SERVER["DOCUMENT_ROOT"]."/database/models/ingredient.php");
        $ingredient = new Ingredient();
        $ingredient->setTitle($_POST["new-ingredient"]);
        $ingredient->save();
    }

    require($_SERVER["DOCUMENT_ROOT"]."/database/ingredients.php");
    $ingredientsFactory = new Ingredients();
    $ingredients = $ingredientsFactory->findAll();
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
                <h2>Zutaten</h2>
            </div>
        </section>
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <ul class="list-group">
                        <form action="/admin/ingredients.php" method="post">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <input class="form-control"  type="text" name="new-ingredient" id="new-ingredient" placeholder="Neue Zutat">
                                <button class="ml-3 btn btn-secondary" type="submit"><i class="far fa-save"></i></button>
                            </li>
                        </form>
                        
                        <?php
                            foreach ($ingredients as $key => $i) {
                                echo '<li class="list-group-item d-flex justify-content-between align-items-center" data-id="'.$i->getId().'">'
                                        .$i->getTitle().
                                        '<a href="/admin/ingredients.php?id='. $i->getId().'"><button class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i></button></a>
                                    </li>';
                            }
                        ?>
                    </ul>
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