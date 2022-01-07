<?php
 $canadian_teams=[8,9,10,52,23,20,22];

include 'db_connect.php';
// Create table if not present
$table = 'vars';
$sql = "CREATE TABLE $table (var_name VARCHAR(50), var_value VARCHAR(50))";

if (mysqli_query($connect, $sql)) {
  $query =  "";
//  echo "Table $table created successfully. ";
  $query .=  "INSERT INTO $table VALUES ('season', '20202021'); "; 
  $query .=  "INSERT INTO $table VALUES ('playernationality', 'SWE'); "; 
  $query .=  "INSERT INTO $table VALUES ('resultlines', '10'); "; 
  $insert = mysqli_multi_query($connect, $query);
        }
else {
//  echo "Error creating table: " . mysqli_error($connect) . " ";
}
$season=(mysqli_fetch_row(mysqli_query($connect,'SELECT var_value FROM vars WHERE var_name="season"')))[0];
$playernationality=(mysqli_fetch_row(mysqli_query($connect,'SELECT var_value FROM vars WHERE var_name="playernationality"')))[0];
$resultlines=(mysqli_fetch_row(mysqli_query($connect,'SELECT var_value FROM vars WHERE var_name="resultlines"')))[0];
echo '<br>';
var_dump ($season);
echo '<br>';
var_dump ($playernationality);
echo '<br>';
var_dump ($resultlines);

// $season = '20202021';
// $playernationality = 'SWE';
// $resultlines = 10;
 ?>
