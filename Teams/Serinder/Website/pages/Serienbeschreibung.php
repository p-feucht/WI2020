<?php session_start();?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Serienbeschreibung - Serinder</title>
    
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/plugins.js"></script>
</head>
<body>
<?php include('./structure/Header.php'); ?>
    <main>
        <div class="inner">
            <h1><?php echo $_SESSION["seriesName"];?></h1>
            <div class="row">
                <div class="series-detail">
                    <div class="imgWrapper col-12 col-md-6"> 
                        <img src=<?php echo $_SESSION["seriesImage_Path"];?>>
                    </div>
                    <div class="interactionWrapper">
                            <div class="row">
                                <div class="col-4">
                                    <a href=<?php echo "../php/markAsFavorite.php?ID=".$_SESSION["seriesID"]."&source=description";?> title="als Favorit markieren">
                                        <img class="nohover" src="../Bilder/star.png">
                                        <img class="hover" src="../Bilder/star-hover.png">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="#" onclick="addClass()" title="Kommentare">
                                        <img class="nohover" src="../Bilder/comment.png">
                                        <img class="hover" src="../Bilder/comment-hover.png">  
                                    </a>
                                    <div class="changePasswordWrapper">
                                        <span class="close" onclick="removeClass()"></span>
                                            <form action="/php/makeComment.php" method="GET">
                                                <h2>Kommentar hinzufügen</h2>
                                                <input type="text" placeholder="Kommentar" minlength="3" maxlength="65000" name="comment">
                                                <input type="hidden" value="description" name="source">
                                                <input type="hidden" value=<?php echo $_SESSION['seriesID'];?> name="series_id">
                                                <button class="button" type="submit">Kommentar abschicken</button>
                                            </form>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <a href="/pages/Startseite.php" title="Zurück zur Startseite">
                                        <img class="nohover" src="../Bilder/back.png">
                                        <img class="hover" src="../Bilder/back-hover.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    <p><?php echo $_SESSION["seriesOverview"];?></p>
                    <br>
                    <p><h3>Bewertung: </h3><?php echo $_SESSION["seriesRating"];?></p>
                    <p><br><h3>Kommentare:</h3></p>
                    <ul>
                        <?php include('../php/seriesComments.php'); ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php include('./structure/LoginForm.html'); ?>
    </main>
    <?php include('./structure/Footer.html'); ?>
</body>
