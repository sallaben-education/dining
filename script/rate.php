<?php
require_once("./connect.php");

session_start();

if(sizeof($_POST) != 8) {
    die("Not a valid form submission, please fill in all areas of the form!");
}

$userID = $_SESSION['UserID'];
$diningID = $_POST['diningID'];
$foodrating = $_POST['food'];
$staffrating = $_POST['staff'];
$pricerating = $_POST['price'];
$cleanrating = $_POST['clean'];
$speedrating = $_POST['speed'];
$comment = strip_tags($_POST['comment']);
$anonymous = $_POST['anonymous'];
$totalrating = ($foodrating + $staffrating + $pricerating + $cleanrating + $speedrating) / 5;
echo "<h1>{$userID}</h1>";
$sql = <<<SQL
    INSERT INTO Ratings (Comment, FoodRating, StaffRating, PriceRating, CleanRating, SpeedRating, DiningID, UserID, TotalRating, Anonymous, Time) 
    VALUES ('{$comment}', {$foodrating}, {$staffrating}, {$pricerating}, {$cleanrating}, {$speedrating}, {$diningID}, {$userID}, {$totalrating}, {$anonymous}, NOW())
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

header("Location: ../info.php?id={$diningID}");

?>