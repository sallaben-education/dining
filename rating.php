<?php
require_once('./script/connect.php');
session_start();

$ratingId = $_GET['id'];
$sql = <<<SQL
    SELECT *
    FROM Ratings
    WHERE RatingID = "{$ratingId}";
SQL;
  if(!$result = $db->query($sql)) {
      die("There was an error running the query [" . $db->error . "]");
  }
if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $comment = $row['Comment'];
    $foodRating = $row['FoodRating'];
    $staffRating = $row['StaffRating'];
    $priceRating = $row['PriceRating'];
    $cleanRating = $row['CleanRating'];
    $speedRating = $row['SpeedRating'];
    $totalRating = $row['TotalRating'];
    $userId = $row['UserID'];
    $anon = $row['Anonymous'];
    $time = $row['Time'];
    $diningId = $row['DiningID'];
    $sql = <<<SQL
    SELECT Name
    FROM DiningHall
    WHERE DiningID = "{$diningId}";
SQL;
    if(!$result = $db->query($sql)) {
      die("There was an error running the query [" . $db->error . "]");
    }
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $diningName = $row['Name'];
    }
    $sql = <<<SQL
    SELECT Name
    FROM Users
    WHERE UserID = "{$userId}";
SQL;
    if(!$result = $db->query($sql)) {
      die("There was an error running the query [" . $db->error . "]");
    }
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($anon) {
            $userName = 'Anonymous'; 
        } else {
            $userName = $row['Name'];
        }
    }
} else {
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
    <title>Rating for <?php echo $diningName; ?></title>
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
    <h1>Rating for <?php
    echo "<a href='./info.php?id={$diningId}'>{$diningName}</a> (by {$userName}) ";
    if(($_SESSION['UserID'] == $userId) || $_SESSION['admin']) {
        echo "<a href='./script/edit.php?id={$ratingId}' style='color: green'>Edit Rating</a>";
    }
    if($_SESSION['admin']) {
        echo "&nbsp;<a href='./script/delete.php?id={$ratingId}' style='color: red'>Delete Rating</a>";
    }
    echo "</h1>" . $comment . "<br><br>";
    echo "<table class='spacedtable'>";
    echo "<tr><th>Category</th><th>My Rating</th></tr>";
    echo "<tr><td>Food Quality: </td><td>{$foodRating} / 5</td></tr>";
    echo "<tr><td>Staff/Service Quality: </td><td>{$staffRating} / 5</td></tr>";
    echo "<tr><td>Price/Value: </td><td>{$priceRating} / 5</td></tr>";
    echo "<tr><td>Cleanliness: </td><td>{$cleanRating} / 5</td></tr>";
    echo "<tr><td>Speed: </td><td>{$speedRating} / 5</td></tr>";
    echo "<tr><td>Overall: </td><td>{$totalRating} / 5</td></tr>";
    echo "</table>";
    ?>
    </div>
</div>
</body>
</html>