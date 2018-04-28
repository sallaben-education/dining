<?php

require_once("./connect.php");

session_start();

if(sizeof($_POST) != 5) {
    die("Not a valid form submission!");
}

$name = strtoupper($_POST['name']);
$uni = $_POST['university'];
$email = strtolower($_POST['email']);
$pwd = $_POST['password'];
$repeat = $_POST['repeat'];

if($pwd != $repeat) {
    die("Password verification failed!");
}

$encrypted = md5($pwd);
$time = time();

$sql = <<<SQL
    INSERT INTO Users (Email, SignupDate, Password, Name) 
    VALUES ('{$email}', NOW(), '{$encrypted}', '{$name}')
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
}

$_SESSION['valid'] = true;

header("Location: ../index.php?msg=" . urlencode("Account successfully created for {$name}!"));

?>