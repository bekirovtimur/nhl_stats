<h1>Data base update tool</h1>
<h3>Create, update, clear DB and tables</h3>

<table class='table table-bordered table-striped'>


<form action="" method="post">

<tr>
<td><b>Main "nhl" DB</b>
<br><p>Main DB of this App</p>
</td>
<td><input type="submit" name="db_test" class="button" value="Test"></td>
<td><input type="submit" name="db_create" class="button" value="Create"></td>
<td></td>
<td><input type="submit" name="db_del" class="button" value="Delete"></td>
</tr>

<tr>
<td><b>Table "vars"</b>
<br><p>Variables for this App</p>
</td>
<td><input type="submit" name="vars_test" class="button" value="Test"></td>
<td><input type="submit" name="vars_create" class="button" value="Create"></td>
<td><input type="submit" name="vars_upd" class="button" value="Set defaults"></td>
<td><input type="submit" name="vars_del" class="button" value="Delete"></td>
</tr>

<tr>
<td><b>Table "games"</b>
<br><p>All games in Canada</p>
</td>
<td><input type="submit" name="games_test" class="button" value="Test"></td>
<td><input type="submit" name="games_create" class="button" value="Create"></td>
<td><input type="submit" name="games_upd" class="button" value="Update"></td>
<td><input type="submit" name="games_del" class="button" value="Delete"></td>
</tr>

<tr>
<td><b>Table "scores"</b>
<br><p>All goals from table "games"</p>
</td>
<td><input type="submit" name="scores_test" class="button" value="Test"></td>
<td><input type="submit" name="scores_create" class="button" value="Create"></td>
<td><input type="submit" name="scores_upd" class="button" value="Update"></td>
<td><input type="submit" name="scores_del" class="button" value="Delete"></td>
</tr>

</form>
</table>
<!--result goes down-->

<p style = 'line-height: 20px'><img src = 'img/term.png' style='vertical-align: middle' width='24'> Console:</p>

<table class='table table-bordered table-striped'>
<tr>
<td>
<font face = "courier" size = "-1" color = "#000000">
<?php
//----------
//CREATE
if(array_key_exists('vars_create', $_POST)) 
  {
    $table = 'vars';
    $sql = "CREATE TABLE $table (var_name VARCHAR(50), var_value VARCHAR(50));";
    include_once 'db_tools/create_table.php';
  }
//
else if(array_key_exists('games_create', $_POST)) 
  {
    $table = 'games';
    $sql = "CREATE TABLE $table (season INT(11), gamePk INT(11), away_team_id INT(11), away_score INT(11), home_team_id INT(11), home_score INT(11), venue VARCHAR(50));";
    include_once 'db_tools/create_table.php';
  }
//
else if(array_key_exists('scores_create', $_POST)) 
  {
    $table = 'scores';
    $sql = "CREATE TABLE $table (gamePk INT(11), player_id INT(11), fullName VARCHAR(50), nationality VARCHAR(3), currentTeam_id INT(3), currentTeam_name VARCHAR(50), goals INT(11), jerseyNumber INT(11));";
    include_once 'db_tools/create_table.php';
  }
//
else if(array_key_exists('db_create', $_POST)) 
  {
    include_once 'db_tools/create_db.php';
  }
//----------
//TEST
else if(array_key_exists('vars_test', $_POST)) 
  {
    $table = 'vars';
    include_once 'db_tools/test_table.php';
  }
//
else if(array_key_exists('games_test', $_POST)) 
  {
    $table = 'games';
    include_once 'db_tools/test_table.php';
  }
//
else if(array_key_exists('scores_test', $_POST)) 
  {
    $table = 'scores';
    include_once 'db_tools/test_table.php';
  }
//  
else if(array_key_exists('db_test', $_POST)) 
  {
    include_once 'db_tools/test_db.php';
  }
//----------
//DELETE
else if(array_key_exists('vars_del', $_POST)) 
  {
    $table = 'vars';
    include_once 'db_tools/del_table.php';
  }
//
else if(array_key_exists('games_del', $_POST)) 
  {
    $table = 'games';
    include_once 'db_tools/del_table.php';
  }
//
else if(array_key_exists('scores_del', $_POST)) 
  {
    $table = 'scores';
    include_once 'db_tools/del_table.php';
  }
//
else if(array_key_exists('db_del', $_POST)) 
  {
    include_once 'db_tools/del_db.php';
  }
//----------
//UPDATE
else if(array_key_exists('vars_upd', $_POST)) 
  {
    include_once 'db_tools/update_vars_table.php';
  }
//
else if(array_key_exists('games_upd', $_POST)) 
  {
    include_once 'db_tools/update_games_table.php';
  }
//
else if(array_key_exists('scores_upd', $_POST)) 
  {
    include_once 'db_tools/update_scores_table.php';
  }
//


//

?>
</font>
</td>
</tr>
</table>

