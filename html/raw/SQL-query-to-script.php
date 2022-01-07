<?php
// Connect to DB
include 'db_connect.php';
if (!$connect) {
 die("Error: " . mysqli_connect_error());
 }


// Create table or truncate if exist
$gamestable = 'games';
$table = 'scores';
$sql = "CREATE TABLE $table (
gamePk INT(11),
player_id INT(11),
fullName VARCHAR(50),
nationality VARCHAR(3),
currentTeam_id INT(3),
goals INT(11),
jerseyNumber INT(11)
)";

if (mysqli_query($connect, $sql)) {
  echo "Table $table created successfully. ";
} else {
  echo "Error creating table: " . mysqli_error($connect) . " ";
  mysqli_query($connect, "TRUNCATE TABLE `$table`");
}

 // Select all games
$sql = "SELECT gamePk FROM $gamestable;";

if (mysqli_query($connect, $sql)) {
  echo "All is OK! ";
} else {
  echo "Error: " . mysqli_error($connect) . " ";
}
// Put games to var, and get info from API
$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_row($result)) {

$gamePk= $row[0];
$url = 'https://statsapi.web.nhl.com/api/v1/game/'.$gamePk.'/boxscore';
$json = file_get_contents($url);
$array = json_decode($json, true);

$players_away = $array['teams']['away']['players'];
foreach ($players_away as $player_away){
    $position = $player_away['position']['type'];
    if ($position == 'Goalie') {
        $goal = $player_away['stats']['goalieStats']['goals'];
    } else {
            $goal = $player_away['stats']['skaterStats']['goals'];
        }
    if ($goal >= 1) {
        $fullName = $player_away['person']['fullName'];
        $nationality = $player_away['person']['nationality'];
        $player_id = $player_away['person']['id'];
        $currentTeam_id = $player_away['person']['currentTeam']['id'];
        if (empty($currentTeam_id)) {
          $currentTeam_id = 0;
          }
        $jerseyNumber = $player_away['jerseyNumber'];
        $query =  "INSERT INTO $table VALUES ('".$gamePk."', '".$player_id."', '".addslashes($fullName)."', '".$nationality."', '".$currentTeam_id."', '".$goal."', '".$jerseyNumber."'); "; 
        if(mysqli_multi_query($connect, $query)) {
          echo 'All is very OK!';
      } else {
          echo "Error! " . mysqli_error($connect);
      }
    }
}

$players_home = $array['teams']['home']['players'];
foreach ($players_home as $player_home){
    $position = $player_home['position']['type'];
    if ($position == 'Goalie') {
        $goal = $player_home['stats']['goalieStats']['goals'];
    } else {
            $goal = $player_home['stats']['skaterStats']['goals'];
        }
    if ($goal >= 1) {
        $fullName = $player_home['person']['fullName'];
        $nationality = $player_home['person']['nationality'];
        $player_id = $player_home['person']['id'];
        $currentTeam_id = $player_home['person']['currentTeam']['id'];
        if (empty($currentTeam_id)) {
          $currentTeam_id = 0;
        }
        $jerseyNumber = $player_home['jerseyNumber'];
        $query =  "INSERT INTO $table VALUES ('".$gamePk."', '".$player_id."', '".addslashes($fullName)."', '".$nationality."', '".$currentTeam_id."', '".$goal."', '".$jerseyNumber."'); "; 
        if(mysqli_multi_query($connect, $query)) {
          echo 'All is very OK!';
      } else {
          echo "Error! " . mysqli_error($connect);
      }
    }
}

}
/*
// Put it to DB
if(mysqli_multi_query($connect, $query)) {
    echo 'All is very OK!';
} else {
    echo "Error! " . mysqli_error($connect);
}
*/
?>
