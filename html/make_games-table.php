<?php
// Connect to DB
include 'db_connect.php';
include 'vars.php';
if (!$connect) {
 die("Error: " . mysqli_connect_error());
 }

// Create table or truncate if exist
$table = 'games';
$sql = "CREATE TABLE $table (
season INT(11),
gamePk INT(11),
away_team_id INT(11),
away_score INT(11),
home_team_id INT(11),
home_score INT(11),
venue VARCHAR(50)
)";

if (mysqli_query($connect, $sql)) {
  echo "Table $table created successfully. ";
} else {
  echo "Error creating table: " . mysqli_error($connect) . " ";
  mysqli_query($connect, "TRUNCATE TABLE `$table`");
}

// Take info from API and put it to DB
$url = 'https://statsapi.web.nhl.com/api/v1/schedule/?season='.$season;
$json = file_get_contents($url);
$array = json_decode($json, true);
$dates = $array['dates'];

foreach ($dates as $date){
    $games = $date['games'];

    foreach ($games as $game){
        $gamePk = $game['gamePk'];
        $away_team_id = $game['teams']['away']['team']['id'];
        $away_score = $game['teams']['away']['score'];
        $home_team_id = $game['teams']['home']['team']['id'];
        $home_score = $game['teams']['home']['score'];
        $venue = $game['venue']['name'];
        if(in_array($home_team_id, $canadian_teams)){
        $query .=  "INSERT INTO $table VALUES ('".$season."', '".$gamePk."', '".$away_team_id."', '".$away_score."', '".$home_team_id."', '".$home_score."', '".$venue."'); "; 
        }
    }
}

if(mysqli_multi_query($connect, $query)) {
    echo 'All OK!';
} else {
    echo "Error! " . mysqli_error($connect);
}
?>
