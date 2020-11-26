<?php
    session_start();
    if($_SESSION["loggedIn"] !== true){
        header("Location: /admin/login.php");
        exit();
    }
    require($_SERVER["DOCUMENT_ROOT"].'/database/models/cocktail.php');
    require($_SERVER["DOCUMENT_ROOT"]."/database/cocktails.php");
    require($_SERVER["DOCUMENT_ROOT"]."/database/image-upload.php");

    $error_message = false;
    $file_name = false;

    if($_FILES["cocktail-image-input"]["name"]) {
        $upload_success = false;
        $target_dir = $_SERVER["DOCUMENT_ROOT"]."/assets/images/cocktails/";
        $file = $_FILES["cocktail-image-input"];
        $target_file = $target_dir . basename($file["name"]);
        if(isImage($target_file)  === false) {
            $error_message = "Datei ist kein Bild mit der Endung .jpg, .jpeg oder .png!";
        }
        if(fileExists($target_file)) {
            $error_message = "Es existiert bereits eine Datei mit dem Name ". basename($file["name"]) . "!";
        }
        if($error_message === false && checkFileSize($file) === false) {
            $error_message = "Das Bild überschreitet die maximale Dateigröße vom 5mb!";
        }
        if($error_message === false) {
            $upload_success = uploadFile($target_file, $file);
        }
        if($upload_success) {
            $file_name = basename($file["name"]);
        }
    }

    $cocktailsFactory = new Cocktails();
    $id = $_GET["id"];
    $cocktail = $cocktailsFactory->findById($id);
    $cocktail->setId($id);
    $cocktail->setTitle($_POST["title-input"]);
    $cocktail->setDescription($_POST["description-input"]);
    $cocktail->setPreparation($_POST["recipe-input"]);
    if($file_name !== false) {
        $cocktail->setImage($file_name);
    }

    foreach($_POST as $field => $value) {
        if(strpos($field, "ingredient-select-") !== false) {
            $iId = trim($field, 'ingredient-select-');
            $cocktail->addIngredient($value, $_POST['ingredient-amount-'.$iId]);
        }
    }
    $cocktail->update();
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkeeper | Admin Cocktail bearbeitet</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <?php
        include($_SERVER["DOCUMENT_ROOT"]."/includes/header-admin.php");
    ?>
    <main role="main">

        <div class="py-5">
            <div class="container">
                <?php
                    if($error_message !== false) {
                        echo '<div class="alert alert-danger" role="alert">'.$error_message.'</div>';
                    }
                    if(isset($cocktail)) {
                        echo '<div class="alert alert-success" role="alert">
                        Der Cocktail "' . $cocktail->getTitle() . '" wurde erfolgreich bearbeitet!
                      </div>';
                    }
                ?>
            </div>
        </div>

    </main>
    <?php
        include($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
    ?>
    <script src="/assets/js/bootstrap-select.min.js"></script>
</body>

</html>