<?php
$baseUrl = 'https://statsapi.web.nhl.com/api/v1/game/{gameId}/boxscore'

//получение списка игр из бд
$gamesList = $dataSource->findAllGames();
$goalList = [];

foreach ($gamesList as $game){
    //берем id
    $gameId = $game->getId();
    $url = str_replase('{gameId}', $gameId, $baseUrl);
    $strJson = file_get_contents($url);
    $arrayJson = json_decode($strJson, true);

    
    foreach ($arrayJson['data'] as $elem) {
        $field = $elem['field'];
        //делаем что нужно

        // формируем данные 
        $goal = ['field' => $field]; 
        $goalList[] = $field;
    }

}

foreach ($goalList as $goal){
    //сохраняем
}
?>