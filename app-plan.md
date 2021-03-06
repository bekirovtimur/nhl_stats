# Раздел 1. Получить таблицу с данными о проведенных играх в интересующем сезоне. 
#
# 1.0 Определиться с сезоном.
# В реализации приложения сезон может быть в виде выпадающего списка на странице (предпочтительнее), или hardcode 
# переменная в коде, или отдельно лежащий файл со значением переменной
#
# 1.1 Берем переменную с указанием созона. Например сезону 2020-2021 будет соответствовать переменная $season=20202021
set $season="20202021"

# 1.2. Делаем запрос к API за json файлом, подставляя переменную $season="20202021"
get https://statsapi.web.nhl.com/api/v1/schedule/?season=$season
# Предполагается, что запрос должен быть интерпретирован так: "https://statsapi.web.nhl.com/api/v1/schedule/?season=20202021"

# 1.3. Получаем json файл, в котором нас интересуют следующие значения по каждой 'gamePk':

     "dates": [
    {
      "games": [
        {
          "gamePk": 2020020001,
          "season": "20202021",
          "teams": {
            "away": {
              "score": 3,
              "team": {
                "id": 5,
              }
            },
            "home": {
              "score": 6,
              "team": {
                "id": 4,
              }
            }
          },
          "venue": {
            "id": 5096,
          },
        }

# 1.4 Всю полученную информацию кладем в БД. Таблица 'games':
# --------------------------------------------------------------------------------------------
# | season   | gamePk     | away_team_id | away_score | home_team_id | home_score | venue_id | 
# --------------------------------------------------------------------------------------------
# | 20202021 | 2020020001 | 5            | 3          | 4            | 6          | 5096     |
# | 20202021 | 2020020002 | 16           | 1          | 14           | 5          | 5017     | 
#
# и так далее (цикл for/while и т.п.) по каждой игре в полученном json файле.



# Раздел 2. Получить таблицу с данными о забитых голах. 
# 2.1. Из таблицы 'games' получить данные столбца gamePk и записать в переменную $games_array. Далее перебирая каждое значение $games_array,
# делать запрос к API, подставляя значение переменной по очереди $games_array[0], $games_array[1], $games_array[2] и т.д. чтобы выгрузить
# информацию о всех играх.
# Например: 
get https://statsapi.web.nhl.com/api/v1/game/$games_array[n]/boxscore 
# Предполагается, что запрос должен быть интерпретирован так: "https://statsapi.web.nhl.com/api/v1/game/2020020001/boxscore"

# 2.1. При каждом запросе получаем json файл, в котором проверям, значение "goals" (if goals > 0). 
# Если goals больше 0 то выгружаем следующие значения по каждому игроку. То есть, выгружаем статистику
# только по тем игрокам, которые забили гол

  "teams": {
    "away": {
      "players": {
        "ID8471675": {
# ID всегда меняется. У каждого игрока свой номер ID
          "person": {
            "id": 8471675,
            "fullName": "Sidney Crosby",
            "nationality": "CAN",
            "currentTeam": {
              "id": 5,
          "jerseyNumber": "87",
            },
          },
          "stats": {
            "skaterStats": {
# Данный параметр "skaterStats", так же может принимать значение "goalieStats". В зависимости от позиции игрока (Игрок/вратарь)
              "goals": 1,
            }
          }
        }
    "home": {
      "players": {
        "ID8474037": {
# ID всегда меняется. У каждого игрока свой номер ID
          "person": {
            "id": 8474037,
            "fullName": "James van Riemsdyk",
            "nationality": "USA",
            "currentTeam": {
              "id": 4,
          "jerseyNumber": "25",
            },
          "stats": {
            "skaterStats": {
# Данный параметр "skaterStats", так же может принимать значение "goalieStats". В зависимости от позиции игрока (Игрок/вратарь)
              "goals": 1,
            }
          }
        },

# 2.2. Всю полученную информацию кладем в БД, где первый столбец, это значение gamePk равное переменной $games_array[n] 
# по которой выполнялся запрос к API (в примере это 2020020001). Таблица 'goals':
# ----------------------------------------------------------------------------------------------
# | gamePk     | player_id | fullName    | nationality | currentTeam_id | goals | jerseyNumber |
# ----------------------------------------------------------------------------------------------
# | 2020020001 | 8471675   | Sidney Cr...| CAN         | 5              | 1     | 87           |
# | 2020020001 | 8474037   | James van...| USA         | 4              | 1     | 25           |
#
# и так далее (цикл for/while и т.п.) по каждому игроку забившему гол, в каждой игре (gamePk) из таблицы БД 'games'

# Раздел 3. Получить таблицу с информацией о командах
# 3.1. Из таблицы 'games' получить все значения столбца home_team_id, отсортировать и унифицировать (избавиться от повторяющихся значений).
# Записать полученный массив в переменную $team_id. Далее перебирая каждое значение по очереди ($team_id[0], $team_id[1], $team_id[2]) 
# выполнять запрос к API https://statsapi.web.nhl.com/api/v1/teams/$team_id[n]. Например:
get https://statsapi.web.nhl.com/api/v1/teams/4
# Из полученного json файла использовать след. информацию:
  "teams": [
    {
      "id": 4,
      "name": "Philadelphia Flyers",
      "venue": {
        "id": 5096,
        "name": "Wells Fargo Center",
        "city": "Philadelphia",
# 3.2. Получить название страны из параметра "city", с помощью стороннего API, предварительно загруженного в память, или в локальный файл.
# Ссылка на API: https://countriesnow.space/api/v0.1/countries
# Интересующие страны ТОЛЬКО "Canada" и "United States"

  "data": [
    {
      "country": "Canada",
      "cities": [
        "100 Mile House",
        "Abbey",
        "Abbotsford",
      "country": "United States",
      "cities": [
        "Abbeville",
        "Abbotsford",
        "Abbottstown",

# 3.3. Из файла со странами и городами, получить соответстие страны, тому городу, который указан в "city" из пункта 3.1., в данном примере
# У команды ID=4, берем значение "city"="Philadelphia" и находим его в json файле, загруженном на шаге 3.2.:
  "data": [
    {
      "country": "United States",
      "cities": [
        "Philadelphia",

# 3.4. Всю полученную информацию заносим в таблицу БД 'teams':
# -------------------------------------------------------------------------------------------------- 
# | team_id | team_name             | venue_id | venue_name       | city           | country       |
# --------------------------------------------------------------------------------------------------
# | 4       | Philadelphia Flyers   | 5096     | Wells Fargo Ce...| Philadelphia   | United States |



# Фотографии игроков:
# https://cms.nhl.bamgrid.com/images/headshots/current/168x168/8477290.jpg
# https://cms.nhl.bamgrid.com/images/headshots/current/168x168/$player_id.jpg
#
#
#