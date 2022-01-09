<?php
include 'vars.php';
include 'db_connect.php';
//
$table = 'scores';
$sql = "SELECT * FROM `$table` LIMIT 1;";
if (mysqli_query($connect, $sql)) 
  {
  } 
else 
  {
    die ("Error: " . mysqli_error($connect));
  }
$query = "SELECT `player_id`,`fullName`,`jerseyNumber`,`currentTeam_id`,`currentTeam_name`,SUM(`goals`) FROM `scores` WHERE `nationality`=\"$playernationality\" GROUP BY `player_id`,`fullName`,`jerseyNumber`,`currentTeam_id`,`currentTeam_name` ORDER BY SUM(`goals`) DESC LIMIT $resultlines;";
$result = mysqli_query($connect,$query);
//
$current_season_query = mysqli_query($connect,"SELECT `season` FROM `games` LIMIT 1;");
$current_season = mysqli_fetch_array($current_season_query)[0];
$start_year = mb_substr($current_season, 0, 4);
$end_year = mb_substr($current_season, 4, 4);
//
echo '<h1>Top '.$resultlines.' list of '.$playernationality.' players of '.$start_year.' - '.$end_year.' season</h1>';
echo '<h3>who scored the maximum number of goals in games in Canada</h3>';
//
if ($current_season!=$season)
  {
  echo '<h5 style="color:red"></b>Warning! Season changed. Please update `games` and `scores` tables.</b></h5>';
  }
//
if ($result == 0)
  {
  die ("No result found");
  }
if (mysqli_num_rows($result) > 0) {
  echo "<table class='table table-bordered table-striped'>";
  echo "<tr>";
  echo "<td>#</td>";
  echo "<td>Player</td>";
  echo "<td>Total goals</td>";
  echo "<td>Photo</td>";
  echo "<td>Team</td>";
  echo "</tr>";
  
  $i=0;
  while($row = mysqli_fetch_array($result)) {
    $player = $row["player_id"];
    $curteamid = $row["currentTeam_id"];
    $curteam = $row["currentTeam_name"];

    echo "<tr>";
    echo "<td>".($i+1)."</td>";
    echo "<td><b>".$row["fullName"]." | #".$row["jerseyNumber"]."</b></td>";
    echo "<td>".$row["SUM(`goals`)"]."</td>";
    echo "<td><img src='https://cms.nhl.bamgrid.com/images/headshots/current/168x168/$player.jpg' alt='N/A' ></td>";
    echo "<td><img src='https://www-league.nhlstatic.com/images/logos/teams-current-primary-dark/$curteamid.svg' alt='N/A' width='100' height='100'>"; 
    echo "<br>";
    echo "<h5 class='pull-left'>$curteam</h5></td>";
    echo "</tr>";
    $i++;
    }
  echo "</table>";
}
else{
echo "No result found";
}
?>
