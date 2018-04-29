<?php 
require_once('./script/connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Dining Disaster</title>
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
    <h1>Search for a Dining Hall</h1>
    <form action="./dininghall.php" method="post">
        <label for="query">Dining Hall Name:</label>
        <input type="text" name="query" id="query">
        <br><br>
        <input type="submit" value="Search">
    </form>
    <h1>Leaderboards</h1>
    <h3>Best Overall</h3>
    <table class="ratings">
    <tr><th>#</th><th>Name</th><th>Average Rating</th></tr>
<?php
$sql = <<<SQL
    SELECT *
    FROM DiningHall AS D, Ratings AS R
    WHERE D.DiningID = R.DiningID
    ORDER BY TotalRating
    LIMIT 5;
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}
$i = 1;
while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$i}</td><td>" . $row['Name'] . "</td><td>" . $row['TotalRating'] . "</td></tr>";
    $i++;
}
?>
    </table>
    <h3>Best Food</h3>
    <table class="ratings">
    <tr><th>#</th><th>Name</th><th>Average Rating</th></tr>
<?php
$sql = <<<SQL
    SELECT *
    FROM DiningHall AS D, Ratings AS R
    WHERE D.DiningID = R.DiningID
    ORDER BY FoodRating
    LIMIT 5;
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

$i = 1;
while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$i}</td><td>" . $row['Name'] . "</td><td>" . $row['FoodRating'] . "</td></tr>";
    $i++;
}
?>
    </table>
    <h3>Fastest Food</h3>
    <table class="ratings">
    <tr><th>#</th><th>Name</th><th>Average Rating</th></tr>
<?php
$sql = <<<SQL
    SELECT *
    FROM DiningHall AS D, Ratings AS R
    WHERE D.DiningID = R.DiningID
    ORDER BY SpeedRating
    LIMIT 5;
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

$i = 1;
while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$i}</td><td>" . $row['Name'] . "</td><td>" . $row['FoodRating'] . "</td></tr>";
    $i++;
}
?>
    </table>
</div>
</body>
</html>