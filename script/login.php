<?php

require_once("./connect.php");

session_start();

if(sizeof($_POST) != 2) {
    die("Not a valid form submission, make sure to fill in all forms!");
}

$email = strtolower($_POST['email']);
$pwd = $_POST['password'];

$encrypted = md5($pwd);

$sql = <<<SQL
    SELECT *
    FROM Users
    WHERE Email='{$email}' AND Password='{$encrypted}';
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

if($result->num_rows <= 0) {
    header("Location: ../login.php?msg=" . urlencode("The username and password you supplied did not match any account."));
} else {

$row = $result->fetch_assoc();
$_SESSION['UserID'] = $row['UserID'];
$_SESSION['Email'] = $row['Email'];
$_SESSION['SignupDate'] = $row['SignupDate'];
$_SESSION['Name'] = $row['Name'];

$sql = <<<SQL
    SELECT *
    FROM Users
    WHERE UserID IN (SELECT UserID FROM Administrator)
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

if($result->num_rows <= 0) {
    $_SESSION['admin'] = false;
} else {
    $_SESSION['admin'] = true;
}

$_SESSION['valid'] = true;

header("Location: ../index.php?msg=" . urlencode("Successfully logged in!"));
}

?>