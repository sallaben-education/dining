<?php

session_start();

require_once("./connect.php");

if(!isset($_GET['id'])) {
    die("No rating ID specified to edit!");
} else {
    $ratingID = $_GET['id'];
}

$sql = <<<SQL
    SELECT * 
    FROM Ratings 
    WHERE RatingID = {$ratingID}
    LIMIT 1
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

$row = $result->fetch_assoc();

if($row['UserID'] != $_SESSION['UserID']) {
    if(!$_SESSION['admin']) {
        die("Not an administrator!");
    } else {
        if(!isset($_GET['pin'])) {
            die("<form action='./edit.php' method='get'><input type='hidden' name='id' value='" . $_GET['id'] . "'>PIN: <input type='text' name='pin'><input type='submit'></form>");
        } else {
            if($_SESSION['pin'] != $_GET['pin']) {
                die("Incorrect PIN!");
            }
        }
    }
}

$sql = <<<SQL
    SELECT * 
    FROM Ratings 
    WHERE RatingID = {$ratingID}
    LIMIT 1
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

$row = $result->fetch_assoc();

$comment = $row['Comment'];
$food = $row['FoodRating'];
$staff = $row['StaffRating'];
$price = $row['PriceRating'];
$clean = $row['CleanRating'];
$speed = $row['SpeedRating'];
$total = $row['TotalRating'];
$anon1 = $row['Anonymous'];
$diningID = $row['DiningID'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/main.css">
    <title>RateMyDining - Edit Rating ?></title>
</head>
<body>
<header>
    <div class="left">
        <div class="logo">
            <a href="../index.php">RateMyDining</a>
        </div>
    </div>
    <div class="right">
        <?php
        echo '<a href="../user.php">' . $_SESSION['Name'] . '</a> &mdash; <span class="logout"><a href="../script/logout.php">Log Out</a></span>';
        ?>
    </div>
</header>
<div class="content">
    <h1>Update your rating</h1>
    <div>Please update your rating each aspect of this dining hall from 1 star (terrible) to 5 stars (excellent).</div><br>
    <form action="./update.php" method="post">
        <input type="hidden" name="ratingID" value="<?php echo $ratingID ?>" />
        <input type="hidden" name="diningID" value="<?php echo $diningID ?>" />
        <table class="ratingtable">
        <tr><th></th><th>1&larr;2&larr;3&rarr;4&rarr;5</th></tr>
        <tr><td><label for="food">Food Quality:</label></td><td>
        <?php
        $i = 0;
        while($i<5) {
            $i++;
            if($food == $i) {
                $checked = " checked";
            } else {
                $checked = "";
            }
            echo "<input type='radio' name='food' value='{$i}'{$checked}>";
        }
        ?>
        </td></tr>
        <tr><td><label for="staff">Staff/Service Quality:</label></td><td>
        <?php
        $i = 0;
        while($i<5) {
            $i++;
            if($staff == $i) {
                $checked = " checked";
            } else {
                $checked = "";
            }
            echo "<input type='radio' name='staff' value='{$i}'{$checked}>";
        }
        ?>
        </td></tr>
        <tr><td><label for="price">Price/Value:</label></td><td>
        <?php
        $i = 0;
        while($i<5) {
            $i++;
            if($price == $i) {
                $checked = " checked";
            } else {
                $checked = "";
            }
            echo "<input type='radio' name='price' value='{$i}'{$checked}>";
        }
        ?>
        </td></tr>
        <tr><td><label for="clean">Cleanliness:</label></td><td>
        <?php
        $i = 0;
        while($i<5) {
            $i++;
            if($clean == $i) {
                $checked = " checked";
            } else {
                $checked = "";
            }
            echo "<input type='radio' name='clean' value='{$i}'{$checked}>";
        }
        ?>
        </td></tr>
        <tr><td><label for="speed">Speed:</label></td><td>
        <?php
        $i = 0;
        while($i<5) {
            $i++;
            if($speed == $i) {
                $checked = " checked";
            } else {
                $checked = "";
            }
            echo "<input type='radio' name='speed' value='{$i}'{$checked}>";
        }
        ?>
        </td></tr>
        <tr><td><label for="comment">Comment:</label</td><td>
        <textarea name="comment" id="comment"><?php echo $comment ?></textarea>
        </td></tr></table>
        <br>
        <br>
        <input type="submit" value="Update Rating">
    </form>
</div>
</body>
</html>