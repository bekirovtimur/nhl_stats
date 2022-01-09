<?php
include 'db_connect.php';
$columns = "SHOW COLUMNS FROM `$table`;";
$query = "SELECT * FROM `$table` ORDER BY RAND() LIMIT 10;";
$colnums = 0;
echo $query."<br>";
//Check connection
if (mysqli_query($connect, $query)) 
  {
//Create table head
    $columns_result = mysqli_query($connect,$columns);
  echo "
       <table class='table table-bordered table-striped'>
       <tr>
       ";
  while($row_head = mysqli_fetch_array($columns_result)) 
    {
    echo "
          <td><b>".$row_head[0]."</b></td>
         ";
    $colnums++;
    }
  echo "
       </tr>
       ";
//Insert values to table
    $query_result = mysqli_query($connect,$query);
    while($row = mysqli_fetch_array($query_result)) 
      {
      echo "<tr>";
      for ($i = 0; $i < $colnums; $i++) 
        {
        echo "<td>".$row[$i]."</td>";
        }
      echo "</tr>
           ";
      }
    echo "</table>";
  }
else 
  {
    echo "Error: " . mysqli_error($connect);
  }
?>
