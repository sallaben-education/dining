<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Project</title>
</head>
<body>
<header>
    <div class="left">
        <div class="logo">
            <a href="./index.php">Project</a>
        </div>
    </div>
    <div class="right">
        <?php
            // check if logged in or not, output correct text (does not work yet!)
            echo '<span class="signup"><a href="./signup.php">Sign Up</a></span>';
            echo '<span class="login"><a href="./login.php">Login</a></span>';
        ?>
    </div>
</header>
<div class="content">
    <h1>Search For Your School</h1>
    <form action="" method="post">
        <label for="query">University name:</label>
        <input type="text" name="query" id="query">
        <br><br>
        <input type="submit" value="Search">
    </form>
</div>
</body>
</html>