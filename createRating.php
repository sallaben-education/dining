<?php
session_start();
if(!isset($_SESSION['valid'])) {
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
    <title>RateMyDining - Rating <?php echo $_SESSION['diningid']; ?></title>
</head>
<body>
<header>
    <div class="left">
        <div class="logo">
            <a href="./index.php">RateMyDining</a>
        </div>
    </div>
    <div class="right">
        <?php
        if(isset($_SESSION['valid'])) {
            echo '<a href="./user.php">' . $_SESSION['Name'] . '</a> &mdash; <span class="logout"><a href="./script/logout.php">Log Out</a></span>';
        } else {
        	//header("Location: ./index.php");
            echo '<span class="signup"><a href="./signup.php">Sign Up</a></span>';
            echo '<span class="login"><a href="./login.php">Log In</a></span>';
        }
        ?>
    </div>
</header>
<div class="content">
    <h1>Rate <?php echo $_SESSION['diningid']; ?></h1>
    <form action="./script/submitRate.php" method="post">
        <label for="name">Total Rating:</label>
        <input type="text" name="name" id="name">
        <br>
        <br>
        <!--<br><br>-->
        <br><br>
        <input type="submit" value="Submit Rating">
    </form>
</div>
</body>
</html>