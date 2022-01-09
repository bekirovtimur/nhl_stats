<?php
include 'db_connect.php';
echo $sql."<br>";
if (mysqli_query($connect, $sql)) 
  {
  echo "Table $table created successfully. ";
  }
else 
  {
  echo "Error creating table $table: " . mysqli_error($connect);
  }
?>
