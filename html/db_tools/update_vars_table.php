<?php
include 'db_connect.php';
$table = 'vars';
$sql = "SELECT * FROM `$table` LIMIT 1;";
echo $sql."<br>";
if (mysqli_query($connect, $sql)) 
  {
    mysqli_query($connect, "TRUNCATE TABLE `$table`");
    $query =  "";
    $query .=  "INSERT INTO $table VALUES ('season', '20202021'); "; 
    $query .=  "INSERT INTO $table VALUES ('playernationality', 'SWE'); "; 
    $query .=  "INSERT INTO $table VALUES ('resultlines', '10'); "; 
    echo "Inserting default values: "."<br>";
    echo $query;
    $insert = mysqli_multi_query($connect, $query);
  }
else 
  {
  echo "Error: " . mysqli_error($connect);
  }
?>
