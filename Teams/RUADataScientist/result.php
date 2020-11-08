<?php
    /*
     * STATIC VARIABLES
     */
    //MAPPING TABLE FOR KNOWLEGDE QUESTIONS AND THEIR RESULTS
    $RESULTS_MAP = array("knowledge_1"=>"1", "knowledge_2"=>"1", "knowledge_3"=>"1", "knowledge_4"=>"1", "knowledge_5"=>"1");
    $RECOMMENDATIONS = array("0"=>"Your low results indicate that a profession in datascience is probably not your best option. However - if you're still interested you might like checking out our collection of datscience-related topics.",
                             "50"=>"You're allready quite well informed and your results indicate that datascience might be for you. We suggest you to gather some more information about the subject. You might consider starting in our topics tab.",
                             "80"=>"Wow! What an amazing result! You should consider doing a deep-dive into the subject of datascience.");
    $RECOMMENDATIONS_ORDER = array(80, 50, 0);

    //REGEX PATTERNS
    $KNOWLEDGE = "/^knowledge/";
    $LIKERT = "/^likert/";

    //A fixed amount for every knowledge question, and a fixed amount for every likert question
    $MAX_SCORE = (5*3) + (9*5); //5 knowledge questions with a max of 3 points each, 9 likert questions with a max of 5 points each.

    //DATABASE
    $servername = "localhost";
    $username = "ruadatascientist_admin";
    $password = "JgFuXukjLwUScgAf";
    $dbname = "ruadatascientist";

    /*
     * SESSION START
     */
    session_start();
    if($_SESSION["results"] === null || $_POST["knowledge_1"] != null) {
        $_SESSION["results"] = getResultsFromForm($_POST);
    }

    /*
     * CONNECT TO THE DATABASE
     */
    $conn = new mysqli($servername, $username, $password, $dbname); 

    /*
     * TRY TO LOG IN THE USER
     */
    $login_success = false;
    $logged_out = false;
    if ($_POST["submit"] === "log me in") {
        $login_success = try_login($_POST);
        if ($login_success) {
            $_SESSION["logged_in"] = true;
            $_SESSION["currentuser"] = test_input($_POST["username"]);
        } 
    }   elseif ($_POST["submit"] === "log me out") {
        $_SESSION["logged_in"] = false;
        $_SESSION["currentuser"] = null;
        $logged_out = true;
    }   

    /*
     * LOGIC
     */
    if ($_SESSION["logged_in"] && $_SESSION["results"] === null) {
        $_SESSION["results"] = getLastResultFromDatabase($conn, $_SESSION["currentuser"]);
    } elseif ($_SESSION["logged_in"]) {
        writeScoreToDatabase($_SESSION["results"], $_SESSION["currentuser"]);
    } 

    /*
     * CLOSE CONNECTION TO DATABASE
     */
    $conn->close();  
?>

<!DOCTYPE html>
<html>
    <title>Result</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/result.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/ico" href="pictures/icon.svg" />
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
    echo "<div class='result-page-content'><br><br>";
    if(!$logged_out) {
       if ($_SESSION["results"] != null) {
            $score = calculateScore($_SESSION["results"]);
            $percentage = scorePercentage($score, $MAX_SCORE);

            if ($_SESSION["logged_in"]) {
                echo "<h2 class='result-page-headline-2'>Hello, ". $_SESSION["currentuser"].".</h1><br><br>";
            }
                echo "<h1 class='result-page-headline'>You scored <b>" . (string)$score . "</b> out of <b>". $MAX_SCORE . "</b> possible Points!</h1>";
                echo "<hr class='result-seperator'>";
                echo "<h2 class='result-page-headline-2'>Thats <b>". $percentage . "</b> percent!</h2>";
                echo "<br>";
                echo "<h3 class='result-page-recommendation'>" . recommendation($percentage) . "</h3>";
        } else {
                echo "<h1 class='result-page-headline'>An error occured while retrieving your score.</h1>";
        }
        
        if(!$_SESSION["logged_in"]) {
            echo "<br><br><br><br>";

            if($_POST["username"] != null) {
                echo "<h3 class='form-title'>An error occured while logging you in. Please try again.</h3>";
            } else {
                echo "<h3 class='form-title'>Would like to save your score to review it in the future? Log in below or create a new account <a href='register.php'>here</a>.</h3>";
            }        
            echo "<br>";
            echo "<form method='POST'>";
                echo "<label for='username'>Username: </label>";
                echo "<input type='text' name='username' id='input-username'>";
                echo "<br>";
                echo "<label for='password'>Password: </label>";
                echo "<input type='password' name='password' id='input-password'>";
                echo "<br>";
                echo "<input class='submit-button' type='submit' name='submit' value='Log Me In'>";
            echo "</form>";
            
        } else {
            echo "<br><br><br><br>";
            echo "<form class='button-form' method='POST'>";
            echo "<input class='submit-button' type ='submit' name='submit' value='Log Me Out'>";
            echo "</form>";
            echo "<form class='button-from' action='test.html'>";
            echo "<input class='submit-button' type ='submit' value='Retake Test'>";
            echo "</form>";
        }
    } else {
        echo "<br><br><br>";
        echo "<h1 class = 'result-page-headline-2'>Logged out successfully.<h1>";
    }
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

<?php
/*
 * FUNCTIONS
 */

//ESCAPE TEST RESULTS FROM POST
function getResultsFromForm($posted_data) {
    $results = array();
    global $KNOWLEDGE;
    global $LIKERT;
    foreach ($posted_data as $question => $answer) {
        if (preg_match($KNOWLEDGE, $question) || preg_match($LIKERT, $question)) {
            $results[$question] = test_input($answer);
        } 
    } 
    if(count($results) < 1){
        return null;
    } else {
        return $results;
    }
}

//GET RESULTS FROM DATABASE
function getLastResultFromDatabase($user) {
    global $conn;

    $sql = "SELECT question_1 'knowledge_1', question_2 'knowledge_2', question_3 'knowledge_3', question_4 'knowledge_4', question_5 'knowledge_5',
            question_6 'likert_1', question_7 'likert_2', question_8 'likert_3', question_9 'likert_4', question_10 'likert_5', question_11 'likert_6', question_12 'likert_7', question_13 'likert_8', question_14 'likert_9',
            FROM results WHERE username = '" . $user . "' AND timestamp = (SELECT MAX(timestamp) FROM username WHERE username = '" . $user . "')";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return null;
    } else {
        $query_result = $conn->query($sql);
        if ($query_result->num_rows < 1) {
            echo "no  score found";
            return null;
        } else {
            return $query_result->fetch_assoc();
        }
    }
}

//DETERMINE THE CORRECT RECOMMENDATION BASED ON THE USERS SCORED PERCENTAGE
function recommendation($score_percent) {
    global $RECOMMENDATIONS_ORDER, $RECOMMENDATIONS;
    foreach($RECOMMENDATIONS_ORDER as $percentage) {
        if($score_percent >= $percentage) {
            return $RECOMMENDATIONS[(string)$percentage];
        }
    }
    return "an error occured in the recommendation() function";
}

//CALCULATE THE USERS SCORE PERCENTAGE FROM HIS POINTS
function scorePercentage($act, $max) {
    return round(($act/$max)*100);
}

//TRY TO LOG THE USER IN
function try_login($posted_data) {
    $password = test_input($posted_data["password"]);
    $username = test_input($posted_data["username"]);
    
    global $conn;
    $sql = "SELECT username, password FROM users WHERE username='". $username ."'";
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $query_result = $conn->query($sql);
        if ($query_result->num_rows < 1) {
            echo "user not found";
            return false;
        } else {
            $row = $query_result->fetch_assoc();
            if($row["passoword"] = hash("sha256", $password)) {
                return true;
            }
            return false;
        }
    }    
}

//WRITE A SCORE TO THE DATABASE
function writeScoreToDatabase($data, $user) {
    global $conn;
    $sql = "INSERT INTO results (username, question_1, question_2, question_3, question_4, question_5, question_6, question_7, question_8, question_9, question_10, question_11, question_12, question_13, question_14) 
            VALUES ('unknown_user', knowledge_1, knowledge_2, knowledge_3, knowledge_4, knowledge_5, likert_1, likert_2, likert_3, likert_4, likert_5, likert_6, likert_7, likert_8, likert_9)";

    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }  else {
        //replace placeholders in query
        foreach ($data as $question => $answer) {
            $sql = str_replace($question, $answer, $sql);
        }
        $sql = str_replace("unknown_user", $user, $sql);

        //try to insert the values
        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }       
}

//VALIDATE INPUT DATA
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//CALCULATE THE USERS SCORE
function calculateScore($results) {
    global $RESULTS_MAP;
    global $KNOWLEDGE;
    $score = 0;
    foreach ($results as $question => $answer) {
        if(preg_match($KNOWLEDGE, $question)){
            if($RESULTS_MAP[$question] == $answer) {
                $score += 3;
            }
        } else {
            $score = $score + (int)$answer;
        }
    }
    return $score;
}
?>