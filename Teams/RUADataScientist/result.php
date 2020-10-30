<?php
    //MAPPING TABLE FOR KNOWLEGDE QUESTIONS AND THEIR RESULTS
    $RESULTS_MAP = array("knowledge_1"=>"0");

    //REGEX PATTERNS
    $KNOWLEDGE = "/^knowledge/";
    $LIKERT = "/^likert/";

    //results
    $results = $_POST;   
    $results_knowledge = array();
    $results_likert = array();

    //split the $results array into a knowlegde and likert part.
    foreach ($results as $question => $answer) {
        if (preg_match($KNOWLEDGE, $question)) {
            $results_knowledge[$question] = test_input($answer);
        } elseif (preg_match($LIKERT, $question)) {
            $results_likert[$question] = test_input($answer);
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>

<!DOCTYPE html>
<html>
    <title>About</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/aboutStyles.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/x-icon" href="pictures/TopBarIcon.png">
<body>
    <!--NAV BAR-->
    <nav>
        <div class="nav-logo">
            <h4><a href="index.html">Are you a data scientist?</a></h4>
        </div>
        <ul class="nav-links">
            <li>
                <a href="test.html">Test</a>
            </li>
            <li>
                <a href="topics.html">Topics</a>
            </li>
            <li>
                <a href="about.html">About</a>
            </li>
        </ul>
    </nav>
    <div class="nav-blocker">''</div>

    <!--CONTENT-->
    <h1>Results</h1>
    <br>
    <?php 
    /*output results for knowledge questions*/
    echo "<h3>Results knowledge:<h3><br>";
    echo "<table><tr><th>Question</th><th>Answer</th></tr>";
    foreach ($results_knowledge as $question => $answer) {
        echo "<tr><td>" . $question . "</td><td>" . $answer . "</td></tr>";
    }
    echo "</table><br>";

    /*output results for likert questions*/
    echo "<h3>Results Likert:<h3><br>";
    echo "<table><tr><th>Question</th><th>Answer</th></tr>";
    foreach ($results_likert as $question => $answer) {
        echo "<tr><td>" . $question . "</td><td>" . $answer . "</td></tr>";
    }
    echo "</table>";
    ?>
        
    <!--FOOTER-->
    <footer>
        <ul class="footer-elements">
            <li>
                <div class="footer-element">© Copyright 2020</div>
            </li>
            <li>
                <a class="footer-link" href="#">Impressum</a>
            </li>
            <li>
                <a class="footer-link" href="#">Datenschutz</a>
            </li>
        </ul>
    </footer>
</body>
</html>