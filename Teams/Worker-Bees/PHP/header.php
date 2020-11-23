   <!-- Outsourced header PHP-file.-->
    <?php session_start(); ?>

    <head>
         
        <!-- insert style sheet and media contents -->
        <link href="CSS/header.css" rel="stylesheet">

    <head>

    


    <!-- header html -->
    <div class="header" id="topHeader">

        <a href="index.php"> <img src="images/logoKomplett.png" class="logo" alt="Worker Bees Logo"></a>
        <div class="header-content-middle">
            <a class="biete" href="FormularBiete.php">Ich biete</a>
            <div class="dropdown">
            <a class="ichSuche">Ich suche</a>
            <div class="dropdown-content">
                <a href="werkzeugPage.php">Werkzeug</a>
                <a href="werkstattPage.php">Werkstatt</a>
                <a href="dienstleistungPage.php">Dienstleistung</a>
            </div>
            </div>
            <a class="tippsandtricks" href="blog.php">Tipps & Tricks</a>
            <a class="aboutus" href="aboutUs.php">Über uns</a>
            <a href="#contact">Impressum</a>
        </div>

        <div class="header-content-right">
            <!-- change the header and its functions if the user is logged in --> 
            <?php 
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                ?> 
                <a href="login.php" class="headerButton">Anmelden</a>
                <?php 
            }

            else {
                ?>
                    <div class="dropdownProfile">
                        <a class="headerButton"><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></a>
                        <div class="dropdownProfileContent">
                            <a href="profile.php">Profil ansehen</a>
                            <a href="logout.php">Abmelden</a>
                        </div>
                    </div>
                    <?php
            } 
                ?>
        </div>
    </div>