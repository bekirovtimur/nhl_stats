<?php
$season= '20202021';
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
        $table_data .= '
        <tr>
            <td>'.$season.'</td>
            <td>'.$gamePk.'</td>
            <td>'.$away_team_id.'</td>
            <td>'.$away_score.'</td>
            <td>'.$home_team_id.'</td>
            <td>'.$home_score.'</td>
            <td>'.$venue.'</td>
        </tr>
        ';
    }
}
echo '
        <table border="1">
        <tr>
            <th width="10%">Season</th>
            <th width="10%">Game ID</th>
            <th width="10%">Away team ID</th>
            <th width="10%">Away team score</th>
            <th width="10%">Home team ID</th>
            <th width="10%">Home score</th>
            <th width="10%">Venue</th>
        </tr>
        ';
        echo $table_data;  
        echo '</table>';

?>