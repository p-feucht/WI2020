<script src="../js/plugins.js"></script>
<header>
        <div class="header">
            <div class="logoWrapper">
                <img src="../Bilder/Logo-Serinder.png" alt="Serinder">
            </div>
            <div class="navigationWrapper">
                <nav id="naviMain" class="nav">
                    <ul>
                        <li>
                            <a class="active" href="./Startseite.php">
                                Startseite
                            </a>
                        </li>
                        <li>
                            <a href="./Serienliste.php">
                                Liste der Serien
                            </a>
                        </li>
                        <li>
                            <a href="../favoriten.html">
                                Meine Favoriten
                            </a>
                        </li>
                        <li>
                            <a href="../kommentare.html">
                                Meine Kommentare
                            </a>
                        </li>
                        <li>
                            <a href="../einstellungen.html">
                                Einstellungen
                            </a>
                        </li>
                        <?php if(isset($_SESSION['session_username'])){ ?>
                        <li>
                            <a href="../php/logout.php" onclick="document.getElementById('modalLogin').style.display='none'">
                                Log Out
                            </a>
                        </li>
                        <?php }else { ?>
                        <li>
                            <a href="#" onclick="document.getElementById('modalLogin').style.display='block'">
                                Log In
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="banner">
            <img src="../Bilder/Banner.jpg" alt="Serinder">
        </div>
    </header>