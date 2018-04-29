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
    <form action="./script/rate.php" method="post">
        <input type="hidden" name="diningID" value="<?php echo $diningID ?>" />
        <label for="name">Total Rating:</label>

        <input type="text" name="name" id="name">
        <br>
        <br>
        <input type="submit" value="Submit Rating">
    </form>
</div>
</body>
</html>