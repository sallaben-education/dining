<?php

session_start();

require_once("./connect.php");

if(!$_SESSION['admin']) {
    die("Not an administrator!");
}

if(!isset($_GET['id'])) {
    die("No rating ID specified to delete!");
}
if(!isset($_GET['pin'])) {
    die("<form action='./delete.php' method='get'><input type='hidden' name='id' value='" . $_GET['id'] . "'>PIN: <input type='text' name='pin'><input type='submit'></form>");
} else {
    if($_SESSION['pin'] != $_GET['pin']) {
        die("Incorrect PIN!");
    }
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