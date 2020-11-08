<html>
<?php


        echo "</div class='result-page-content'>";
            echo "<h3 class='form-title'>Would like to save your score to review it in the future? Log in below or create a new account <a href='newAccount.php'>here</a>.</h3>";       
        echo "<br>";
        echo "<form method='POST' action='result.php'>";
            echo "<label for='username'>Username: </label>";
            echo "<input type='text' name='username' id='input-username'>";
            echo "<br>";
            echo "<label for='password'>Password: </label>";
            echo "<input type='password' name='password' id='input-password'>";
            echo "<br>";
            echo "<input type='submit' name='submit' value='log me in'>";
        echo "</form>";
        echo "</div>";
?>
</html>