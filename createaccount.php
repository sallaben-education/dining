<?php

require_once("./db/connect.php");

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

$sql = <<<SQL
    INSERT INTO Users (Email, SignupDate, Password, Name) 
    VALUES ('{$email}', NOW(), '{$encrypted}', '{$name}')
SQL;

if(!$result = $db->query($sql)) {
    die("There was an error running the query [" . $db->error . "]");
} else {
    echo "Account successfully created for {$name}!";
}

?>
