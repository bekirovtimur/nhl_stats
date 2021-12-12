<!DOCTYPE html>
<html>
      
<head>
    <title>
        Database update tool
    </title>
</head>
  
<body style="text-align:center;">
      
    <h1 style="color:green;">
        Database update tool
    </h1>
      
    <h4>
        Update DB using NHL API
        or go back to main menu
    </h4>
  
    <?php
      
        if(isset($_POST['UpdateDB'])) {
//            echo "Update DB function called";


                $connect = mysqli_connect("mysql", "root", "root", "nhl"); 
                $query = '';
                $table_data = '';

                // json file name
                $filename = "https://statsapi.web.nhl.com/api/v1/schedule/?season=20202021";

                // Read the JSON file in PHP
                $data = file_get_contents($filename); 

                // Convert the JSON String into PHP Array
                $array = json_decode($data, true); 
                $peoples = $array['dates'];
                // Extracting row by row
                foreach($peoples as $row) {

                    // Database query to insert data 
                    // into database Make Multiple 
                    // Insert Query 
                    $query .=  "INSERT INTO dates VALUES ('".$row["date"]."', '".$row["totalGames"]."','".$row["totalEvents"]."'); "; 
   
                    $table_data .= '
                    <tr>
                        <td>'.$row["date"].'</td>
                        <td>'.$row["totalGames"].'</td>
                        <td>'.$row["totalEvents"].'</td>
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
                        <th width="10%">totalGames</th>
                        <th width="45%">totalEvents</th>
                    </tr>
                    ';
                    echo $table_data;  
                    echo '</table>';
                }
//*/        
        }
        if(isset($_POST['Back'])) {
            echo "Back to menu function called";
        }
    ?>
      
    <form method="post">
        <input type="submit" name="UpdateDB"
                value="Update DB"/>
          
        <input type="submit" name="Back"
                value="Back"/>
    </form>
</head>
  
</html>