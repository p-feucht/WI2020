<?php


// Kleine Funktion zum schauen ob die aktuelle URL die URL eines Links ist
function isActive($linkPath) {
    $uri = $_SERVER['REQUEST_URI'];
    if ($uri == $linkPath) {
        echo "active";
    }
}

?>



<header>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color: #F7BFBF !important;">
        <div class="container d-flex justify-content-between">
            <a href="index.php" class="navbar-brand d-flex align-items-center">
                <img src="/assets/images/barkeeper_logo.png" alt="Barkeeper Logo" height="60">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php isActive("/"); ?><?php isActive("/index.php"); ?>">
                        <a class="nav-link" href="index.php">Home</span></a>
                    </li>
                    <li class="nav-item <?php isActive("/cocktail-finder.php"); ?>">
                        <a class="nav-link" href="cocktail-finder.php">Rezeptsuche</a>
                    </li>
                    <li class="nav-item <?php isActive("/own-recipe.php"); ?>">
                        <a class="nav-link" href="own-recipe.php">Dein Rezept teilen</a>
                    </li>
                    <li class="nav-item <?php isActive("/tipps.php"); ?>">
                        <a class="nav-link" href="tipps.php">Tipps & Tricks</a>
                    </li>
                    <li class="nav-item <?php isActive("/impress.php"); ?>">
                        <a class="nav-link" href="impress.php">Impressum</a>
                    </li>
                    <li class="nav-item <?php isActive("/contact.php"); ?>">
                        <a class="nav-link" href="contact.php">Kontakt</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>