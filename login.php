<?php
session_start();
if(isset($_SESSION['valid'])) {
    header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Dining Disaster - Login</title>
</head>
<body>
<header>
    <div class="left">
        <div class="logo">
            <a href="./index.php">Dining Disaster</a>
        </div>
    </div>
    <div class="right">
        <span class="signup">
            <a href="./signup.php">Sign Up</a>
        </span>
        <span class="login active">
            <a href="./login.php">Login</a>
        </span>
    </div>
</header>
<div class="content">
<?php
if(sizeof($_GET) == 1 && $_GET['msg'] != NULL) {
    $msg = strip_tags(urldecode($_GET['msg']));
    echo "<div class='error'>{$msg}</div>";
}
?>
    <h1>Log In</h1>
    <form action="./script/login.php" method="post">
        <label for="username">Email address:</label>
        <input type="text" name="email" id="email">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br><br>
        <input type="submit" value="Log In">
    </form>
</div>
</body>
</html>