<?php
include_once 'vars.php';
echo '<h1>App configuration page</h1>';
echo '<h3></h3>';
  echo "<table class='table table-bordered table-striped'>";
  echo "<tr>";
  echo "<td>Option</td>";
  echo "<td>Value</td>";
  echo "</tr>";

  echo '<form action="" method="post">';


    echo '<tr>';
    echo '<td><b>Season</b></td>';
    echo '<td><input type=text name="season" value="'.$season.'"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><b>Nationality</b></td>';
    echo '<td><input type=text name="nationality" value="'.$playernationality.'"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><b>Top players</b></td>';
    echo '<td><input type=text name="resultlines" value="'.$resultlines.'"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><input type=submit name="save" value="Save"></td>';
    echo '</tr>';


if(isset($_POST['save'])) {
      $season=$_POST['season'];
      $playernationality=$_POST['nationality'];
      $resultlines=$_POST['resultlines'];
      
      $query =  '';
      $query .=  'UPDATE vars SET var_value="'.$season.'" WHERE var_name="season"; '; 
      $query .=  'UPDATE vars SET var_value="'.$playernationality.'" WHERE var_name="playernationality"; '; 
      $query .=  'UPDATE vars SET var_value="'.$resultlines.'" WHERE var_name="resultlines"; '; 
      $insert = mysqli_multi_query($connect, $query);
echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
    }
    echo '</form>';
?>







