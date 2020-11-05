<?php
    //MAPPING TABLE FOR KNOWLEGDE QUESTIONS AND THEIR RESULTS
    $RESULTS_MAP = array("knowledge_1"=>"0");
    $RECOMMENDATIONS = array("0"=>"Your low results indicate that a profession in datascience is probably not your best option. However - if you're still interested you might like checking out our collection of datscience-related topics.",
                             "50"=>"You're allready quite well informed and your results indicate that datascience might be for you. We suggest you to gather some more information about the subject. You might consider starting in our topics tab.",
                             "80"=>"Wow! What an amazing result! You should consider doing a deep-dive into the subject of datascience.");
    $RECOMMENDATIONS_ORDER = array(80, 50, 0);

    //A fixed amount for every knowledge question, and a fixed amount for every likert question
    $MAX_SCORE = 9; //3 questions atm. 3 points max per question

    //REGEX PATTERNS
    $KNOWLEDGE = "/^knowledge/";
    $LIKERT = "/^likert/";

    //results
    $results_no_escape = $_POST;   
    $results_final = array();
    $score = 0;
    
    //split the $results array into a knowlegde and likert part.
    foreach ($results_no_escape as $question => $answer) {
        if (preg_match($KNOWLEDGE, $question) || preg_match($LIKERT, $question)) {
            $results_final[$question] = test_input($answer);
        } 
    }

    //calculate the users score
    foreach ($results_final as $question => $answer) {
        if(preg_match($KNOWLEDGE, $question)){
            if($RESULTS_MAP[$question] == $answer) {
                $score += 3;
            }
        } else {
            $score = $score + (int)$answer;
        }
    }

    
    //DATABASE
    $servername = "localhost";
    $username = "ruadatascientist_admin";
    $password = "JgFuXukjLwUScgAf";
    $dbname = "ruadatascientist";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    //define query
    $sql = "INSERT INTO results (username, question_1, question_2, question_3)
    VALUES ('test', knowledge_1, likert_1, likert_2)";
    
    //instert values into string
    foreach ($results_final as $question => $answer) {
        $sql = str_replace($question, $answer, $sql);
    }

    //try to insert the values
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    //disconnect
    $conn->close();

    //function for validating input data
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    //function for determining the correct recommendation
    function recommendation($score_percent) {
        global $RECOMMENDATIONS_ORDER, $RECOMMENDATIONS;
        foreach($RECOMMENDATIONS_ORDER as $percentage) {
            if($score_percent >= $percentage) {
                return $RECOMMENDATIONS[(string)$percentage];
            }
        }
        return "an error occured in the recommendation() function";
    }

    function scorePercentage($act, $max) {
        return round(($act/$max)*100);
    }
?>

<!DOCTYPE html>
<html>
    <title>About</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/result.css">
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
                <a class="active" href="test.html">Test</a>
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
    <?php 
    /*output results for knowledge questions*/
    /*
    echo "<h3>Results knowledge:<h3>";
    echo "<table><tr><th>Question</th><th>Answer</th></tr>";
    foreach ($results_knowledge as $question => $answer) {
        echo "<tr><td>" . $question . "</td><td>" . $answer . "</td></tr>";
    }
    echo "</table><br>";
    */

    /*output results for likert questions*/
    /*echo "<h3>Results Likert:<h3>";
    echo "<table><tr><th>Question</th><th>Answer</th></tr>";
    foreach ($results_likert as $question => $answer) {
        echo "<tr><td>" . $question . "</td><td>" . $answer . "</td></tr>";
    }
    echo "</table><br>";
    */

    /*output the users calculated score*/
    echo "<div class='result-page-content'><br><br><br>";
    echo "<h1 class='result-page-headline'>You scored <b>" . $score . "</b> out of <b>" . $MAX_SCORE . "</b> possible Points!</h1>";
    echo "<hr class='result-seperator'>";
    echo "<h2 class='result-page-headline-2'>Thats <b>" . scorePercentage($score, $MAX_SCORE) . "</b> percent!</h2>";
    echo "<br><h3 class='result-page-recommendation'>" . recommendation(scorePercentage($score, $MAX_SCORE)) . "</h3>";
    echo "</div>";
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