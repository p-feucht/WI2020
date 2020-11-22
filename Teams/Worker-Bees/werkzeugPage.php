<?php @session_start(); ?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="images/logoBiene.png" />
    <title>Worker Bees</title>
    <meta name="description" content="">

    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- pop up window for booking -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- sheets for general page and other --> 
    <link href="CSS/categoriesDesign.css" rel="stylesheet">
    <link href="JavaScript/categoriesFunctions.js">
    <script type="text/javascript" src="JavaScript/offerFunctions.js"></script> <!-- used in the offer files only --> 
    <link href="JavaScript/filter.js">
    <link rel="stylesheet" href="CSS/bookingWindowDesign.css">

</head>

<body>

<?php include "PHP/header.php"; ?>

<div class="yellow-banner"></div>

        <?php include "PHP/searchField.php"; ?>
        <?php include "PHP/werkzeugOffers.php"; ?>

<?php include "PHP/footer.php"; ?>

</body>

</html>