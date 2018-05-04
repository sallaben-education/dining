<?php
require_once("./connect.php");

session_start();

if(sizeof($_POST) != 8) {
    die("Not a valid form submission, please fill in all areas of the form!");
}

$ratingID = $_POST['ratingID'];
$userID = $_SESSION['UserID'];
$diningID = $_POST['diningID'];
$foodrating = $_POST['food'];
$staffrating = $_POST['staff'];
$pricerating = $_POST['price'];
$cleanrating = $_POST['clean'];
$speedrating = $_POST['speed'];
$comment = strip_tags($_POST['comment']);
$totalrating = ($foodrating + $staffrating + $pricerating + $cleanrating + $speedrating) / 5;
echo "<h1>{$userID}</h1>";
$sql = <<<SQL
    UPDATE Ratings
    SET Comment="{$comment}", FoodRating="{$foodrating}", StaffRating="{$staffrating}", PriceRating="{$pricerating}", CleanRating="{$cleanrating}", SpeedRating="{$speedrating}", TotalRating="{$totalrating}"
    WHERE RatingID="{$ratingID}"
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

header("Location: ../rating.php?id={$ratingID}");

?>