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
    <title>RateMyDining <?php echo $query ?></title>
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
echo '<table><tr><td class="leftcell">';
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
  echo "<h1>" . $row['Name'] . "</h1>School: <strong>" . $row['SchoolName'] . "</strong><br><br>";
  echo "Average price: <strong>" . $row['Price'] . "</strong><br><br>";

$sql = <<<SQL
    SELECT COUNT(*) as NumRatings
    FROM Ratings
    WHERE DiningID = "{$diningID}";
SQL;
if(!$result = $db->query($sql)) {
  die("There was an error running the query [" . $db->error . "]");
}
$row = $result->fetch_assoc();
  echo "Number of ratings: <strong>" . $row['NumRatings'] . "</strong>";

  if (isset($_SESSION['valid'])) {
    echo "<h3><a href='./rate.php?id={$diningID}'>Leave Rating</a></h3>";
  }
  echo "<h4>Recent Ratings:</h4>";
echo '</td><td>';
$sql = <<<SQL
    SELECT AVG(FoodRating) as Food, AVG(StaffRating) as Staff, AVG(PriceRating) as Price, AVG(CleanRating) as Clean, AVG(SpeedRating) as Speed, AVG(TotalRating) as Total
    FROM Ratings 
    GROUP BY DiningID 
    HAVING DiningID='{$diningID}';
SQL;
  if(!$result = $db->query($sql)) {
      die("There was an error running the query [" . $db->error . "]");
  }
  $row = $result->fetch_assoc();
<<<<<<< HEAD
  echo '<br><h4>Average Ratings in Categories:</h4>';
  echo 'Food Rating: ' . $row['Food'] . '<br>Staff Rating: ' . $row['Staff'] . '<br>Price Rating: ' . $row['Price'];
  echo '<br>Clean Rating: ' . $row['Clean'] . '<br>Speed Rating: ' . $row['Speed'] . '<br>Total Rating: ' . $row['Total'];



if (isset($_SESSION['valid'])) {
  echo "<br><br><a href='./rate.php?id={$diningID}'>Create Rating</a><br><br>";
}
echo '<h4>Hours: </h4>';
$sql = <<<SQL
    SELECT *
    FROM Hours
    WHERE DiningID = "{$diningID}";
SQL;
  if(!$result = $db->query($sql)) {
      die("There was an error running the query [" . $db->error . "]");
  }
  $i = 1;
if($result->num_rows > 0) {
  echo "<table class='spacedtable'><tr><th>Day</th><th>Time of Day</th><th>Start Time</th><th>End Time</th></tr>";
}
while($row = $result->fetch_assoc()) {
  $timeday = "Morning";
  if ($row['TimeOfDay'] == 0) {
    $timeday = "Morning";
  } else if ($row['TimeOfDay'] == 1) {
    $timeday = "Afternoon";
  } else if ($row['TimeOfDay'] == 2) {
    $timeday = "Night";
  }
  echo "<tr><td>" . $row['Day'] . "</td><td>" . $timeday . "</td><td>" . $row['Stime'] . "</td><td> " . $row['Etime'] . "</td></tr>";
  $i++;
}
if($i == 1) {
  echo "<br>No matching results!";
} else {
  echo "</table>";
}
=======
  echo '<br>';
  echo '<table class="spacedtable averages">';
  echo '<tr><th>Category</th><th>Rating</th></tr>';
  echo '<tr><td>Food Quality:</td><td>' . $row['Food'] . '</td></tr>';
  echo '<tr><td>Staff:</td><td>' . $row['Staff'] . '</td></tr>';
  echo '<tr><td>Price/Value:</td><td>' . $row['Price'] . '</td></tr>';
  echo '<tr><td>Cleanliness:</td><td>' . $row['Clean'] . '</td></tr>';
  echo '<tr><td>Speed:</td><td>' . $row['Speed'] . '</td></tr>';
  echo '<tr><td>Total Rating:</td><td>' . $row['Total'] . '</td></tr>';
  echo '</table>';
  echo '</td></tr></table>';
>>>>>>> cd138b9805aa97a0e6c487fcdc5cba4d97dfe81d

echo '<h4>Food: </h4>';
$sql = <<<SQL
    SELECT *
    FROM Ratings
    WHERE DiningID = "{$diningID}" ORDER BY Time LIMIT 20;
SQL;
  if(!$result = $db->query($sql)) {
      die("There was an error running the query [" . $db->error . "]");
  }
  $i = 1;
if($result->num_rows > 0) {
  echo "<table class='spacedtable'><tr><th>#</th><th>Total Rating</th><th>Comment</th><th>User</th></tr>";
}
while($row = $result->fetch_assoc()) {
  if ($row['Anonymous']) {
    echo "<tr><td>{$i}</td><td>" . $row['TotalRating'] . "</td><td><a href='rating.php?id=" . $row['RatingID'] . "'>" . $row['Comment'] . "</a></td><td>Anonymous</td></tr>";
  } else {
    echo "<tr><td>{$i}</td><td>" . $row['TotalRating'] . "</td><td><a href='rating.php?id=" . $row['RatingID'] . "'>" . $row['Comment'] . "</a></td><td>" . $row['UserID'] . "</td></tr>";
  }
  $i++;
}
if($i == 1) {
  echo "No ratings have been submitted for this dining hall!<br><br>";
} else {
  echo "</table><br>";
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
if($i != 1) {
  echo "</table>";
}
}
?>
</div>
</body>
</html>
