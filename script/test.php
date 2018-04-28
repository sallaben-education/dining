<?php

require_once('connect.php');

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