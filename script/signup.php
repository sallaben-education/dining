<?php

require_once("./connect.php");

session_start();

if(sizeof($_POST) != 6) {
    die("Not a valid form submission, please fill in all areas of the form!");
}

$name = strtoupper($_POST['name']);
$email = strtolower($_POST['email']);
$pwd = $_POST['password'];
$repeat = $_POST['repeat'];
$userType = $_POST['usertype'];

if($pwd != $repeat) {
    die("Password verification failed, make sure to enter the same password twice!");
}

$encrypted = md5($pwd);

$sql = <<<SQL
    INSERT INTO Users (Email, SignupDate, Password, Name) 
    VALUES ('{$email}', NOW(), '{$encrypted}', '{$name}')
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

$sql = <<<SQL
    SELECT *
    FROM Users
    WHERE Email='{$email}';
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

$row = $result->fetch_assoc();
$_SESSION['UserID'] = $row['UserID'];
$_SESSION['SignupDate'] = $row['SignupDate'];
$_SESSION['Email'] = $email;
$_SESSION['Name'] = $name;
$_SESSION['usertype'] = $userType;

$myUserId = $row['UserID'];

if(!strcmp($userType, 'student')) {
	$sql = <<<SQL
		INSERT INTO Student (UserID) 
		VALUES ('{$myUserId}') 
SQL;

	if(!$result = $db->query($sql)) {
    	die("There was an error running the query [" . $db->error . "]");
	}
	$_SESSION['swipes'] = '0';
	$_SESSION['declining'] = '0';
} else {
	$sql = <<<SQL
		INSERT INTO Faculty (UserID) 
		VALUES ('{$myUserId}') 
SQL;

	if(!$result = $db->query($sql)) {
    	die("There was an error running the query [" . $db->error . "]");
	}

}

$sql = <<<SQL
    SELECT *
    FROM Administrator
    WHERE UserID = '{$_SESSION['UserID']}'
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['admin'] = true;
    $_SESSION['pin'] = $row['PIN'];
} else {
    $_SESSION['admin'] = false;
}

$_SESSION['valid'] = true;

header("Location: ../index.php?msg=" . urlencode("Account successfully created for {$name}!"));

?>