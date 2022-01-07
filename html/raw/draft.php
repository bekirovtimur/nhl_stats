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
//        $game = new Game($gamePk, $season, $away_team_id, $away_score, $home_team_id, $home_score, $venue);
//        $gamesList[] = $game;
    
// show table
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
        



//        echo '<pre>';
//        print_r($venue);
//        echo '<pre>';
    
    }
}
/*
foreach ($gamesList as $game){
    //save $game
    //echo '<pre>';
    //var_dump($game);
    //echo '</pre>';
    //echo '---';
    //echo '<pre>';
    //print_r($venue);
    //echo '<pre>';
    //print_r($gamePk);
    //print_r($season);
}
*/
/*
class Game {
    private $gamePk;
    private $season;
    private $away_team_id;
    private $away_score;
    private $home_team_id;
    private $home_score;
    private $venue;

    public function __construct($gamePk, $season, $away_team_id, $away_score, $home_team_id, $home_score, $venue)
    {
        $this->gamePk = $gamePk;
        $this->season = $season;
        $this->away_team_id = $away_team_id;
        $this->away_score = $away_score;
        $this->home_team_id = $home_team_id;
        $this->home_score = $home_score;
        $this->venue = $venue;
    }

    public function getGamePk()
    {
        return $this->gamePk;
    }

    public function setGamePk($gamePk): void
    {
        $this->gamePk = $gamePk;
    }

    public function getSeason()
    {
        return $this->season;
    }

    public function setSeason($season): void
    {
        $this->season = $season;
    }

    public function getAwayTeamID()
    {
        return $this->away_team_id;
    }

    public function setAwayTeamID($away_team_id): void
    {
        $this->away_team_id = $away_team_id;
    }

    public function getAwayScore()
    {
        return $this->away_score;
    }

    public function setAwayScore($away_score): void
    {
        $this->away_score = $away_score;
    }

    public function getHomeTeamID()
    {
        return $this->home_team_id;
    }

    public function setHomeTeamID($home_team_id): void
    {
        $this->home_team_id = $home_team_id;
    }

    public function getHomeScore()
    {
        return $this->home_score;
    }

    public function setHomeScore($home_score): void
    {
        $this->home_score = $home_score;
    }

    public function getVenue()
    {
        return $this->venue;
    }

    public function setVenue($venue): void
    {
        $this->venue = $venue;
    }

}
*/

echo '
        <table border="1">
        <tr>
            <th width="10%">season</th>
            <th width="10%">gamePk</th>
            <th width="10%">away_team_id</th>
            <th width="10%">away_score</th>
            <th width="10%">home_team_id</th>
            <th width="10%">home_score</th>
            <th width="10%">venue</th>
        </tr>
        ';
        echo $table_data;  
        echo '</table>';

?>