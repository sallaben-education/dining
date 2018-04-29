<?php

$db = new mysqli('localhost', 'USERNAME', 'PASSWORD', 'DATABASE');

if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = <<<SQL
    SELECT *
    FROM Users
SQL;

if(!$result = $db->query($sql)) {
    die('There was an error running the query [' . $db->error . ']');
}

while($row = $result->fetch_assoc()) {
    echo $row['Email'] . '<br />';
}

?>