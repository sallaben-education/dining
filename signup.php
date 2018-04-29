<?php
session_start();
if(isset($_SESSION['valid'])) {
    header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Dining Disaster - Sign Up</title>
</head>
<body>
<header>
    <div class="left">
        <div class="logo">
            <a href="./index.php">Dining Disaster</a>
        </div>
    </div>
    <div class="right">
        <span class="signup active">
            <a href="./signup.php">Sign Up</a>
        </span>
        <span class="login">
            <a href="./login.php">Log In</a>
        </span>
    </div>
</header>
<div class="content">
    <h1>Sign Up</h1>
    <form action="./script/signup.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <br>
        <label for="university">University:</label>
        <select name="university" id="university">
            <option value="0">University of Rochester</option>
            <!--<option value="1">Harvard University </option>
            <option value="2">Massachusetts Institute of Technology</option>-->
        </select>
        <br>
        <label for="email">University Email:</label>
        <input type="text" name="email" id="email">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <label for="repeat">Repeat Password:</label>
        <input type="password" name="repeat" id="repeat">
        <!--<br><br>-->
        <div>
        	<label for="student">Student?</label>
        	<input type="radio" name="usertype" id="student" value="student">
        	<br>
        	<label for="faculty">Faculty?</label>
        	<input type="radio" name="usertype" id="faculty" value="faculty">
        </div>
        <br><br>
        <input type="submit" value="Sign Up">
    </form>
</div>
</body>
</html>