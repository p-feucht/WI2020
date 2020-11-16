 <?php session_start(); ?>

 <!-- Outsourced header PHP-file.-->
    <head>
         
        <!-- insert style sheet and media contents -->
        <link href="CSS/header.css" rel="stylesheet">

        <!-- Load icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <head>


    <!-- header html -->
    <div class="header" id="topHeader">

        <a href="index.php"> <img src="images/logoKomplett.png" class="logo" alt="Worker Bees Logo"></a>
        <div class="header-content-middle">
            <a class="biete" href="FormularBiete.php">Ich biete</a>
            <a href="categories.php">Angebote</a>
            <a href="blog.php">Tipps & Tricks</a>
            <a class="aboutus" href="aboutUs.php">Über uns</a>
            <a href="#contact">Impressum</a>
        </div>

        <div class="header-content-right">

            <?php 
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            ?> 
            <a href="login.php" class="headerButton">Anmelden</a>
            <?php
        }
            else {
                ?>
                <a href="logout.php" class="headerButton">Abmelden</a>
                <?php
                
            
            } 
            ?>
        
            <a href="categories.php" class="headerButton" id="headerSearch" ><i class="fa fa-search"></i></a>
        </div>
    </div>