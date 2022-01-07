<?php
 $canadian_teams=[8,9,10,52,23,20,22];
include 'db_connect.php';
$season=(mysqli_fetch_row(mysqli_query($connect,'SELECT var_value FROM vars WHERE var_name="season"')))[0];
$playernationality=(mysqli_fetch_row(mysqli_query($connect,'SELECT var_value FROM vars WHERE var_name="playernationality"')))[0];
$resultlines=(mysqli_fetch_row(mysqli_query($connect,'SELECT var_value FROM vars WHERE var_name="resultlines"')))[0];
?>
