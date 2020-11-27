<!--Bestellungsfelder, die Menge und Nachricht bei fehlgeschlagenen Bestellung behalten-->

<div id="order_div">
    <h2>Bestellung:</h2>
    <form method="POST">
        <input placeholder="Menge" name="amount" type="number" step=".1" value="<?php if (isset($_SESSION['menge'])) {
                                                                                    echo ($_SESSION['menge']);
                                                                                } else {
                                                                                    echo "";
                                                                                } ?>" tabindex="1" required>
        <?php if (isset($_SESSION['annotation'])) {
            echo ("<p style='color: red'>Die angegebene Menge ist nicht verfügbar!</p>");
            unset($_SESSION['annotation']);
        } else {
            echo "<p></p>";
        } ?>
        <textarea id="order" name="annotation" row="4" cols="50" placeholder="Bestellung" tabindex="1"><?php if (isset($_SESSION['annotation'])) {
                                                                                                            echo ($_SESSION['annotation']);
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        }
                                                                                                        if (isset($_SESSION['text'])) {
                                                                                                            echo ($_SESSION['text']);
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?></textarea>
        <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Bestellen</button>
    </form>
</div>