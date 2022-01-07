<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Result Table</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style type="text/css">
.bs-example{
margin: 20px;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();   
});
</script>
</head>
<body>
<?php
include 'vars.php';
include 'db_connect.php';
 ?>
<div class="bs-example">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="page-header clearfix">
<?php echo '<h1 class="pull-left">Top '.$resultlines.' list of '.$playernationality.' players</h1>'; ?>
<h3 class="pull-left">who scored the maximum number of goals in games in Canada</h3>
</div>
<?php
$query = "SELECT `player_id`,`fullName`,`jerseyNumber`,`currentTeam_id`,`currentTeam_name`,SUM(`goals`) FROM `scores` WHERE `nationality`=\"$playernationality\" GROUP BY `player_id`,`fullName`,`jerseyNumber`,`currentTeam_id`,`currentTeam_name` ORDER BY SUM(`goals`) DESC LIMIT $resultlines;";
$result = mysqli_query($connect,$query);
?>
<?php
if (mysqli_num_rows($result) > 0) {
?>
<table class='table table-bordered table-striped'>
<tr>
<td>#</td>
<td>Player</td>
<td>Total goals</td>
<td>Photo</td>
<td>Team</td>
</tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
$player = $row["player_id"];
$curteamid = $row["currentTeam_id"];
$curteam = $row["currentTeam_name"];
?>
<tr>
<td><?php echo ($i+1); ?></td>
<td><b><?php echo $row["fullName"]." | #".$row["jerseyNumber"]; ?></b></td>
<td><?php echo $row["SUM(`goals`)"]; ?></td>
<td><?php echo "<img src='https://cms.nhl.bamgrid.com/images/headshots/current/168x168/$player.jpg' alt='N/A' >"; ?></td>
<td><?php echo "<img src='https://www-league.nhlstatic.com/images/logos/teams-current-primary-dark/$curteamid.svg' alt='N/A' width='100' height='100'>"; 
echo '<br>';
echo '<h5 class="pull-left">'.$curteam.'</h5>';
?>

</td>
</tr>
<?php
$i++;
}
?>
</table>
<?php
}
else{
echo "No result found";
}
?>
</div>
</div>        
</div>
</div>
</body>
</html>
