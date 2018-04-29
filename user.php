<?php
require_once('./script/connect.php');
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
    <title><?php echo $_SESSION['Name']; ?></title>
</head>
<body>
<header>
    <div class="left">
        <div class="logo">
            <a href="./index.php">Dining Disaster</a>
        </div>
    </div>
    <div class="right">
        <?php
        if(isset($_SESSION['valid'])) {
            echo '<a href="./user.php">' . $_SESSION['Name'] . '</a> &mdash; <span class="logout"><a href="./script/logout.php">Log Out</a></span>';
        } else {
            echo '<span class="signup"><a href="./signup.php">Sign Up</a></span>';
            echo '<span class="login"><a href="./login.php">Log In</a></span>';
        }
        ?>
    </div>
</header>
<div class="content">
<?php
if(sizeof($_GET) == 1 && $_GET['msg'] != NULL) {
    $msg = strip_tags(urldecode($_GET['msg']));
    echo "<div class='message'>{$msg}</div>";
}
?>
    <h1>Hello <?php echo $_SESSION['Name']; ?>!</h1>
    <div>
        <div>Email: <?php echo $_SESSION['Email']; ?></div>
        <div>Account Created On: <?php echo $_SESSION['SignupDate']; ?></div>
        <div>Account Type: 
            <?php echo $_SESSION['usertype'];
            if (!strcmp($_SESSION['usertype'], 'student')) {
                echo '<div>Swipes: ' . $_SESSION['swipes'] . '</div>';
                echo '<div>Declining: ' . $_SESSION['declining'] . '</div>';
            }
            ?>
        </div>

    </div>
    <br><br><br><br>
    <div>
    <form action="./script/updateStudent.php" method="post">
    <?php 
        if (!strcmp($_SESSION['usertype'], 'student')) {
            echo '<div>Update Declining: </div>';
            echo '<input type="number" step="0.01" name="declining" id="declining">';
            echo '<div>Update Swipes: </div>';
            echo '<input type="number" step="1" name="swipes" id="swipes">';
            echo '<input type="submit" value="Update">';
        }
    ?>
    </form>
    </div>
</div>
</body>
</html>