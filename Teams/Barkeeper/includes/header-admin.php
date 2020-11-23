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
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img src="/assets/images/barkeeper_logo.png" alt="Barkeeper Logo" height="60">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php isActive("/admin/cocktails.php"); ?><?php isActive("/index.php"); ?>">
                        <a class="nav-link" href="/admin/cocktails.php">Cocktails</span></a>
                    </li>
                    <li class="nav-item <?php isActive("/admin/ingredients.php"); ?>">
                        <a class="nav-link" href="/admin/ingredients.php">Zutaten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php">Zurück zur Website</a>
                    </li>
                </ul>
                <a class="btn btn-danger my-2 my-sm-0" href="/admin/logout.php">Logout</a>
            </div>
        </div>
    </nav>

</header>