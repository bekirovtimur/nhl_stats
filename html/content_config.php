<?php
include 'db_connect.php';
include 'vars.php';
echo '<h1>App configuration page</h1>';
echo '<h3></h3>';
//check season
$current_season_query = mysqli_query($connect,"SELECT `season` FROM `games` LIMIT 1;");
if ($current_season_query) 
  {
  } 
else 
  {
    die ("Error: " . mysqli_error($connect));
  }
$current_season = mysqli_fetch_array($current_season_query)[0];
$start_year = mb_substr($current_season, 0, 4);
$end_year = mb_substr($current_season, 4, 4);
//
if ($current_season!=$season)
  {
    echo '<h5 style="color:red"></b>Warning! Season changed. Please update `games` and `scores` tables.</b></h5>';
  }
//
  echo "<table class='table table-bordered table-striped'>";
  echo "<tr>";
  echo "<td>Option</td>";
  echo "<td>Value</td>";
  echo "</tr>";
  echo '<form action="" method="post">';
//
    echo '<tr>';
    echo '<td><b>Season</b></td>';
    echo '<td>';
    echo '<select name="season">';
    
    for ($i = 1; $i < 10; $i++) 
      {
        $start_year = (date("Y") - $i);
        $end_year = (date("Y") - $i + 1);
        if($start_year.$end_year==$season)
          {
            $slct = " selected ";
          }
        else
          {
            $slct = "";
          }
        echo '<option value="'.$start_year.$end_year.'"'.$slct.'">'.$start_year."-".$end_year.'</option>';
      }
    echo '</select>';
    echo '</td>';
    echo '</tr>';
//
    $natio_query = "SELECT `nationality` FROM `scores` GROUP BY `nationality`;";
    $natio_result = mysqli_query($connect, $natio_query);
    echo '<tr>';
    echo '<td><b>Nationality</b></td>';
    echo '<td>';
    echo '<select name="nationality">';
    while($row = mysqli_fetch_array($natio_result))
      {
        if($row[0]==$playernationality)
          {
            $slct = " selected ";
          }
        else
          {
            $slct = "";
          }
    echo '<option value="'.$row[0].'"'.$slct.'">'.$row[0].'</option>';
      }
    if (is_null(mysqli_fetch_array($natio_result)))
      {
        echo '<option value="'.$playernationality.'"'.$slct.'">'.$playernationality.'</option>';
      }
    echo '</select>';
    echo '</td>';
    echo '</tr>';
//
    echo '<tr>';
    echo '<td><b>Top players</b></td>';
    echo '<td><input type=text name="resultlines" value="'.$resultlines.'"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><input type=submit name="save" value="Save"></td>';
    echo '</tr>';
//
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
