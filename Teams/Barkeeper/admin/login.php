<?php
if($_SERVER['REQUEST_METHOD'] == "GET") {
    session_start();
    if(isset($_SESSION["loggedIn"])){
        if($_SESSION["loggedIn"] === true){
            header("Location: /admin/cocktails.php");
            exit();
        }
    }
   
}
$loginFailed = false;

if($_SERVER['REQUEST_METHOD'] == "POST") {
    require($_SERVER["DOCUMENT_ROOT"]."/database/users.php");
    $usersFactory = new Users();
    $user = $usersFactory->login($_POST["username"], $_POST["pw"]);
    //print_r($user);
    if($user) {
        session_start();
        $_SESSION["loggedIn"] = true;
        $_SESSION["user"] = $user;
        header("Location: /admin/cocktails.php");
        exit();
    } else {
        $loginFailed = true;
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/signin.css">
</head>

<body class="text-center">
    <form class="form-signin" action="/admin/login.php" method="POST">
        <img class="mb-4" src="/assets/images/barkeeper_logo.png" alt="" height="100">
        <h1 class="h3 mb-3 font-weight-normal">Management Login</h1>
        <?php
            if($loginFailed) {
                echo '<div class="alert alert-primary" role="alert">
                    Falsches Passwort oder Benutzername!
                </div>';
            }
        ?>
        <label for="username-input" class="sr-only">Benutzername</label>
        <input type="text" id="username-input" name="username" class="form-control" placeholder="Benutzername" required>
        <label for="pw-input" class="sr-only">Password</label>
        <input type="password" id="pw-input" name="pw" class="form-control" placeholder="Passwort" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <a class="btn btn-lg btn-outline-info btn-block" href="/index.php">Zurück zur Seite</a>
    </form>
</body>

</html>