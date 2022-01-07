<?php
 include 'db_connect.php';
  if (!$connect) {
   die("Ошибка: " . mysqli_connect_error());
 }
 //$query = "SELECT * FROM games LIMIT 1;"; // Проверить подключение к таблице
 //$query = "TRUNCATE TABLE games;"; // Очистить таблицу
 //$query = "CREATE TABLE games (season INTEGER, gamePk INTEGER, away_team_id INTEGER, away_score INTEGER, home_team_id INTEGER, home_score INTEGER, venue_id VARCHAR(30));";
 if(mysqli_query($connect, $query)){
     echo "Таблица games успешно создана";
 } else{
     echo "Ошибка: " . mysqli_error($connect);
 }
 mysqli_close($connect);
 ?>



