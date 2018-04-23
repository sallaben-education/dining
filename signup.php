<?php
    // check if logged in or not. if logged in, send them back to the homepage! (does not work yet!)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Project - Sign Up</title>
</head>
<body>
<header>
    <div class="left">
        <div class="logo">
            <a href="./index.php">Project</a>
        </div>
    </div>
    <div class="right">
        <span class="signup active">
            <a href="./signup.php">Sign Up</a>
        </span>
        <span class="login">
            <a href="./login.php">Login</a>
        </span>
    </div>
</header>
<div class="content">
    <h1>Sign Up</h1>
    <form action="" method="post">
        <label for="username">Name:</label>
        <input type="text" name="name" id="name">
        <br>
        <label for="university">University:</label>
        <select name="university" id="university">
            <option value="0">University of Rochester</option>
            <option value="1">Placeholder University</option>
            <option value="2">Placeholder University</option>
        </select>
        <br>
        <label for="email">University Email:</label>
        <input type="text" name="email" id="email">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <label for="password">Repeat Password:</label>
        <input type="password" name="password" id="password">
        <br><br>
        <input type="submit" value="Sign Up">
    </form>
</div>
</body>
</html>