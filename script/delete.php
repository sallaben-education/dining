<?php
require_once("./connect.php");

session_start();

if(!$_SESSION['admin']) {
    die("Not an administrator!");
}

if(!isset($_GET['id'])) {
    die("No rating ID specified to delete!");
}

$ratingID = $_GET['id'];

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
$diningID = $row['DiningID'];

$sql = <<<SQL
    DELETE FROM Ratings 
    WHERE RatingID = {$ratingID}
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

header("Location: ../info.php?id={$diningID}");

?>