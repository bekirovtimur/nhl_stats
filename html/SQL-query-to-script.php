<?php
// Connect to DB
include 'db_connect.php';
if (!$connect) {
 die("Ошибка: " . mysqli_connect_error());
 }

 // Select all games
$table = 'games';
$sql = "SELECT gamePk FROM $table;";

if (mysqli_query($connect, $sql)) {
  echo "All is OK! ";
} else {
  echo "Error: " . mysqli_error($connect) . " ";
}
// Put games to var, and get info from API
$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_row($result)) {
    //printf("%s (%s)\n", $row[0], $row[1]);
//    echo $row[0];

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
        $jerseyNumber = $player_away['jerseyNumber'];
        $table_data .= '
        <tr>
            <td>'.$gamePk.'</td>
            <td>'.$player_id.'</td>
            <td>'.$fullName.'</td>
            <td>'.$nationality.'</td>
            <td>'.$currentTeam_id.'</td>
            <td>'.$goal.'</td>
            <td>'.$position.'</td>
            <td>'.$jerseyNumber.'</td>
        </tr>
        ';
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
        $jerseyNumber = $player_home['jerseyNumber'];
        $table_data .= '
        <tr>
            <td>'.$gamePk.'</td>
            <td>'.$player_id.'</td>
            <td>'.$fullName.'</td>
            <td>'.$nationality.'</td>
            <td>'.$currentTeam_id.'</td>
            <td>'.$goal.'</td>
            <td>'.$position.'</td>
            <td>'.$jerseyNumber.'</td>
        </tr>
        ';
    }
}
echo $table_data;  
}
    echo '
        <table border="1">
        <tr>
            <th width="10%">Game ID</th>
            <th width="10%">Player ID</th>
            <th width="10%">Name</th>
            <th width="10%">Nationality</th>
            <th width="10%">Current Team ID</th>
            <th width="10%">Goals</th>
            <th width="10%">Position</th>
            <th width="10%">Jersey Number</th>
        </tr>
        ';
        echo $table_data;  
        echo '</table>';

/*
// Take info from API and put it to DB
$season = '20202021';
$url = 'https://statsapi.web.nhl.com/api/v1/schedule/?season='.$season;
$gamesList = [];

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
        $query .=  "INSERT INTO $table VALUES ('".$season."', '".$gamePk."', '".$away_team_id."', '".$away_score."', '".$home_team_id."', '".$home_score."', '".$venue."'); "; 
    }
}

if(mysqli_multi_query($connect, $query)) {
    echo 'All OK!';
} else {
    echo "Error! " . mysqli_error($connect);
}
*/
?>
