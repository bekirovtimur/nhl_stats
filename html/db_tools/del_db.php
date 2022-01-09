<?php
include 'db_conf.php';
$connect = mysqli_connect($db_server, $db_username, $db_password); 
$query = "DROP DATABASE nhl;";
echo $query."<br>";
if (!$connect)
  {
    die("Error: " . mysqli_connect_error());
  }
if (mysqli_query($connect, $query))
  {
    echo "Database successfully deleted";
  } 
else
  {
    echo "Error: " . mysqli_error($connect);
  }
mysqli_close($connect);
?>
