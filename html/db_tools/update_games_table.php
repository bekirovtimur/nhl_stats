<?php
include 'db_connect.php';
include 'vars.php';
if (!$connect) 
  {
    die("Error: " . mysqli_connect_error());
  }

$table = 'games';
$sql = "SELECT * FROM `$table` LIMIT 1;";

if (mysqli_query($connect, $sql)) 
  {
    echo "Erasing data from $table table.<br>";
    mysqli_query($connect, "TRUNCATE TABLE `$table`");
    echo "Done.<br>";
    $url = 'https://statsapi.web.nhl.com/api/v1/schedule/?season='.$season;
    $json = file_get_contents($url);
    $array = json_decode($json, true);
    $dates = $array['dates'];
    $query =  "";
    echo "Updating $table table from $url <br> It might take a while, please be patient.<br>";
    foreach ($dates as $date)
      {
        $games = $date['games'];
        foreach ($games as $game)
          {
            $gamePk = $game['gamePk'];
            $away_team_id = $game['teams']['away']['team']['id'];
            $away_score = $game['teams']['away']['score'];
            $home_team_id = $game['teams']['home']['team']['id'];
            $home_score = $game['teams']['home']['score'];
            $venue = $game['venue']['name'];
            if(in_array($home_team_id, $canadian_teams))
              {
                $query .=  "INSERT INTO $table VALUES ('".$season."', '".$gamePk."', '".$away_team_id."', '".$away_score."', '".$home_team_id."', '".$home_score."', '".$venue."'); "; 
              }
          }
      }

  if(mysqli_multi_query($connect, $query))
    {
      echo 'Update complited';
    }
  else 
    {
      echo "Error! " . mysqli_error($connect);
    }
  }
else 
  {
    echo "Error: " . mysqli_error($connect);
  }
?>
