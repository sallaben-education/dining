<?php

require_once("./connect.php");

session_start();

if(sizeof($_POST) != 2) {
    die("Not a valid form submission, Please fill in all areas of the form!");
}

$declining = $_POST['declining'];
$swipes = $_POST['swipes'];
$UserID = $_SESSION['UserID'];

$sql = <<<SQL
    UPDATE Student SET Swipes='{$swipes}' WHERE UserID='{$UserID}'
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

$sql = <<<SQL
    UPDATE Student SET Declining='{$declining}' WHERE UserID='{$UserID}'
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

$_SESSION['swipes'] = $swipes;
$_SESSION['declining'] = $declining;

header("Location: ../user.php?msg=" . urlencode("Successfully updated your Swipes and Declining!"));

?>