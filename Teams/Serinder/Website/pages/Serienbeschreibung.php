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
            <h1>Serienbeschreibung</h1>
            <div class="row">
                <div class="series-detail">
                    <h2><?php echo $_SESSION["seriesName"];?></h2>
                    <img src=<?php echo $_SESSION["seriesImage_Path"];?>>
                    <p>Info zu Serie: <?php echo $_SESSION["seriesOverview"];?></p>
                    <p>Bewertung: </p>
                </div>
            </div>
        </div>
        <?php include('./structure/LoginForm.html'); ?>
    </main>
    <?php include('./structure/Footer.html'); ?>
</body>
