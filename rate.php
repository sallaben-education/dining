<?php
session_start();
require_once('./script/connect.php');
if(!isset($_SESSION['valid'])) {
    header("Location: ./index.php");
}
$diningID = strip_tags(urldecode($_GET['id']));
if(isset($_GET['id'])) {
    $sql = <<<SQL
    SELECT *
    FROM DiningHall
    WHERE DiningID = "{$diningID}";
SQL;
    if(!$result = $db->query($sql)) {
        die("There was an error running the query [" . $db->error . "]");
    }
    if($result->num_rows <= 0) {
        die("Invalid dining hall ID!");
    }
    $dining = $result->fetch_assoc();
} else {
    die("No dining ID provided!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>RateMyDining - Rate <?php echo $dining['Name']; ?></title>
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
        echo '<a href="./user.php">' . $_SESSION['Name'] . '</a> &mdash; <span class="logout"><a href="./script/logout.php">Log Out</a></span>';
        ?>
    </div>
</header>
<div class="content">
    <h1>Rate <?php echo $dining['Name']; ?></h1>
    <div>Please rate each aspect of this dining hall from 1 star (terrible) to 5 stars (excellent).</div><br>
    <form action="./script/rate.php" method="post">
        <input type="hidden" name="diningID" value="<?php echo $diningID ?>" />
        <table class="ratingtable">
        <tr><th></th><th>1&larr;2&larr;3&rarr;4&rarr;5</th></tr>
        <tr><td><label for="food">Food Quality:</label></td><td>
        <input type="radio" name="food" value="1">
        <input type="radio" name="food" value="2">
        <input type="radio" name="food" value="3" checked>
        <input type="radio" name="food" value="4">
        <input type="radio" name="food" value="5">
        </td></tr>
        <tr><td><label for="staff">Staff/Service Quality:</label></td><td>
        <input type="radio" name="staff" value="1">
        <input type="radio" name="staff" value="2">
        <input type="radio" name="staff" value="3" checked>
        <input type="radio" name="staff" value="4">
        <input type="radio" name="staff" value="5">
        </td></tr>
        <tr><td><label for="price">Price/Value:</label></td><td>
        <input type="radio" name="price" value="1">
        <input type="radio" name="price" value="2">
        <input type="radio" name="price" value="3" checked>
        <input type="radio" name="price" value="4">
        <input type="radio" name="price" value="5">
        </td></tr>
        <tr><td><label for="clean">Cleanliness:</label></td><td>
        <input type="radio" name="clean" value="1">
        <input type="radio" name="clean" value="2">
        <input type="radio" name="clean" value="3" checked>
        <input type="radio" name="clean" value="4">
        <input type="radio" name="clean" value="5">
        </td></tr>
        <tr><td><label for="speed">Speed:</label></td><td>
        <input type="radio" name="speed" value="1">
        <input type="radio" name="speed" value="2">
        <input type="radio" name="speed" value="3" checked>
        <input type="radio" name="speed" value="4">
        <input type="radio" name="speed" value="5">
        </td></tr>
        <tr><td><label for="comment">Comment:</label</td><td>
        <textarea name="comment" id="comment"></textarea>
        </td></tr>
        <tr><td><label for="anonymous">Display your name next to this rating:</label></td><td>
        <input type="radio" name="anonymous" value="false" checked>Yes
        <input type="radio" name="anonymous" value="true">No
        </td></tr></table>
        <br>
        <br>
        <input type="submit" value="Submit Rating">
    </form>
</div>
</body>
</html>