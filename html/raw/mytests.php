<?php
 $connect = mysqli_connect("mysql", "root", "root", "nhl"); 
 $query = '';
 $table_data = '';
 $season='20202021';
 // json file name
// $season_json = "https://statsapi.web.nhl.com/api/v1/schedule/?season=20202021";
// Read the JSON file in PHP
//$data = file_get_contents($season_json); 
$season_json = file_get_contents("https://statsapi.web.nhl.com/api/v1/schedule/?season=$season"); 
// Convert the JSON String into PHP Array
$season_data = json_decode($season_json, true); 
$dates = $season_data['dates'];
// Extracting row by row
               foreach($dates as $dates_row) {
                    
                    $query .=  "INSERT INTO dates VALUES ('".$dates_row["date"]."', '".$dates_row["games"][0]["gamePk"]."','".$dates_row["games"][0]["gameDate"]."'); "; 
   
                    $table_data .= '
                    <tr>
                        <td>'.$dates_row["date"].'</td>
                        <td>'.$dates_row["games"][0]["gamePk"].'</td>
                        <td>'.$dates_row["games"][0]["gameDate"].'</td>
                    </tr>
                    '; // Data for display on Web page
                }
               
    ///*
                if(mysqli_multi_query($connect, $query)) {
                    echo '<h3>Inserted JSON Data</h3><br />';
                    echo '
                    <table class="table table-bordered">
                    <tr>
                        <th width="45%">date</th>
                        <th width="10%">gamePk</th>
                        <th width="45%">totalEvents</th>
                    </tr>
                    ';
                    echo $table_data;  
                    echo '</table>';
                }
//*/        
                
?>