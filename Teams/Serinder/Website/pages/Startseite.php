<?php session_start();?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Startseite - Serinder</title>

    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/plugins.js"></script>
</head>

<body>
    <?php include('./structure/Header.php'); ?>

    <main>
        <div class="inner">
            <h1>Welche Serie findest du besser?</h1>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="seriesWrapper">
                        <h3><?php echo $_SESSION["randomSeriesName1"];?></h3>
                        <div class="imgWrapper">
                            <img src=<?php echo $_SESSION["randomSeriesImage_Path1"];?> alt="<?php echo $_SESSION["randomSeriesName1"];?>">
                        </div>
                        <div class="interactionWrapper">
                            <div class="row">
                                <div class="col-4">
                                    <a href="#" title="als Favorit markieren">
                                        <img class="nohover" src="../Bilder/star.png">
                                        <img class="hover" src="../Bilder/star-hover.png">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href=<?php echo "../php/seriesDescription.php?ID=".$_SESSION["randomSeriesId1"];?> title="Infos zur Serie">
                                        <img class="nohover" src="../Bilder/info.png">
                                        <img class="hover" src="../Bilder/info-hover.png">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="#" title="Kommentare">
                                        <img class="nohover" src="../Bilder/comment.png">
                                        <img class="hover" src="../Bilder/comment-hover.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="seriesWrapper">
                        <h3><?php echo $_SESSION["randomSeriesName2"];?></h3>
                        <div class="imgWrapper">
                            <img src=<?php echo $_SESSION["randomSeriesImage_Path2"];?> alt="<?php echo $_SESSION["randomSeriesName2"];?>">
                        </div>
                        <div class="interactionWrapper">
                            <div class="row">
                                <div class="col-4">
                                    <a href="#" title="als Favorit markieren">
                                        <img class="nohover" src="../Bilder/star.png">
                                        <img class="hover" src="../Bilder/star-hover.png">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href=<?php echo "../php/seriesDescription.php?ID=".$_SESSION["randomSeriesId2"];?> title="Infos zur Serie">
                                        <img class="nohover" src="../Bilder/info.png">
                                        <img class="hover" src="../Bilder/info-hover.png">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="#" title="Kommentare">
                                        <img class="nohover" src="../Bilder/comment.png">
                                        <img class="hover" src="../Bilder/comment-hover.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="buttonWrapper">
                <a class="button" href="../php/randomSeries.php">Überspringen</a>
            </div>


            <?php include('./structure/LoginForm.html'); ?>
        </div>
    </main>
    

    <?php include('./structure/Footer.html'); ?>

</body>