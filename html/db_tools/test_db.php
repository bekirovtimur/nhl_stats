<?php
include 'db_connect.php';
// Create table
$query = "SHOW TABLES;";
echo $query."<br>";
if (mysqli_query($connect, $query)) 
  {
    $result = mysqli_query($connect,$query);
    echo "
         <table class='table table-bordered table-striped'>
         <tr>
         <td><b>Tables_in_nhl</b></td>
         </tr>
         ";
    while($row = mysqli_fetch_array($result)) 
      {
      echo "<tr>
            <td>$row[0]</td>
            </tr>
           ";
      }
    echo "</table>";
  }
else 
  {
    echo "Error: " . mysqli_error($connect);
  }
?>
