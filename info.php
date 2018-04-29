<?php
require_once('./script/connect.php');
session_start();

$query = strip_tags(urldecode($_GET['query']));
$diningID = strip_tags(urldecode($_GET['id']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>RateMyDining - <?php echo $query ?></title>
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
            echo $_SESSION['Name'] . ' &mdash; <span class="logout"><a href="./script/logout.php">Log Out</a></span>';
        } else {
            echo '<span class="signup"><a href="./signup.php">Sign Up</a></span>';
            echo '<span class="login"><a href="./login.php">Log In</a></span>';
        }
        ?>
    </div>
</header>
<div class="content">
<div class="left">
    <h1>Search for a Dining Hall</h1>
    <form action="./info.php" method="get">
        <label for="query">Dining Hall Name:</label>
        <input type="text" name="query" id="query">
        <br><br>
        <input type="submit" value="Search">
    </form>
    <h1>Search results: "<?php 
    if(isset($_GET['query'])) {
      echo $query;
    } else {
      echo "*";
    }
    ?>"</h1>
<?php
// *** *** *** *** *** *** ***
//          Search
// *** *** *** *** *** *** ***
$sql = <<<SQL
    SELECT *
    FROM DiningHall
    WHERE Name LIKE "%{$query}%"
    LIMIT 20;
SQL;
if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}
$i = 1;
if($result->num_rows > 0) {
  echo "<table class='spacedtable'><tr><th>#</th><th>Name</th><th>School</th><th>Average Price</th></tr>";
}
while($row = $result->fetch_assoc()) {
  echo "<tr><td>{$i}</td><td><a href='./info.php?id=" . $row['DiningID'] . "'>" . $row['Name'] . "</a></td><td>" . $row['SchoolName'] . "</td><td>" . $row['Price'] . "</td></tr>";
  $i++;
}
if($i == 1) {
  echo "No matching results!";
} else {
  echo "</table>";
}
echo "</div><div class='right'>";
// *** *** *** *** *** *** ***
// Specific dining hall info
// *** *** *** *** *** *** ***
if(isset($_GET['id'])) {
$sql = <<<SQL
    SELECT *
    FROM DiningHall
    WHERE DiningID = "{$diningID}";
SQL;
  if(!$result = $db->query($sql)) {
      die("There was an error running the query [" . $db->error . "]");
  }
  $row = $result->fetch_assoc();
  echo "<h1>" . $row['Name'] . "</h1>School: " . $row['SchoolName'] . "<br>Price: " . $row['Price'];

$_SESSION['diningid'] = $row['Name'];
if (isset($_SESSION['valid'])) {
  echo "<br><a href='./createRating.php'>Create Rating</a>";
}
$sql = <<<SQL
    SELECT *
    FROM Food, FoodType
    WHERE Food.DiningID = "{$diningID}" AND Food.FoodName = FoodType.FoodName;
SQL;
  if(!$result = $db->query($sql)) {
      die("There was an error running the query [" . $db->error . "]");
  }
$i = 1;
if($result->num_rows > 0) {
  echo "<table class='spacedtable'><tr><th>#</th><th>Food</th><th>FoodType</th><th>Price</th></tr>";
}
while($row = $result->fetch_assoc()) {
  echo "<tr><td>{$i}</td><td>" . $row['FoodName'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['Price'] . "</td></tr>";
  $i++;
}
if($i == 1) {
  echo "<br>No matching results!";
} else {
  echo "</table>";
}
}
?>
</div>
</body>
</html>
