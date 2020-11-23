<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Startseite - Serinder</title>

    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/plugins.js"></script>
</head>

<body>
    <?php include("./pages/structure/Header.php"); ?>
    <main>
        <div class="inner">
            <h1>Um die Funktionalitäten freizuschalten bitte anmelden!<br></h1>
            <h1>Welche Serie findest du besser?</h1>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="seriesWrapper">
                        <h3>Stranger Things</h3>
                        <div class="imgWrapper">
                            <img src="./Bilder/strangerthings.jpg" alt="Stranger Things">
                        </div>
                        <div class="interactionWrapper">
                            <div class="row">
                                <div class="col-4">
                                    <a href="#" title="als Favorit markieren">
                                        <img class="nohover" src="./Bilder/star.png">
                                        <img class="hover" src="./Bilder/star-hover.png">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="#" title="Infos zur Serie">
                                        <img class="nohover" src="./Bilder/info.png">
                                        <img class="hover" src="./Bilder/info-hover.png">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="#" title="Kommentare">
                                        <img class="nohover" src="./Bilder/comment.png">
                                        <img class="hover" src="./Bilder/comment-hover.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="seriesWrapper">
                        <h3>Haus des Geldes</h3>
                        <div class="imgWrapper">
                            <img src="./Bilder/hausdesgeldes.jpg" alt="Haus des Geldes">
                        </div>
                        <div class="interactionWrapper">
                            <div class="row">
                                <div class="col-4">
                                    <a href="#" title="als Favorit markieren">
                                        <img class="nohover" src="./Bilder/star.png">
                                        <img class="hover" src="./Bilder/star-hover.png">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="#" title="Infos zur Serie">
                                        <img class="nohover" src="./Bilder/info.png">
                                        <img class="hover" src="./Bilder/info-hover.png">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="#" title="Kommentare">
                                        <img class="nohover" src="./Bilder/comment.png">
                                        <img class="hover" src="./Bilder/comment-hover.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="buttonWrapper">
                <a class="button" href="#">Überspringen</a>
            </div>
        </div>
        <?php include("./pages/structure/LoginForm.html"); ?>
    </main>
    <?php include("./pages/structure/Footer.html"); ?>
</body>