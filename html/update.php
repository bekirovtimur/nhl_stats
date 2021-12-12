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


                $connect = mysqli_connect("mysql", "root", "root", "test"); 
                $query = '';
                $table_data = '';

                // json file name
                $filename = "https://records.nhl.com/site/api/player?cayenneExp=nationality=%22SWE%22";

                // Read the JSON file in PHP
                $data = file_get_contents($filename); 

                // Convert the JSON String into PHP Array
                $array = json_decode($data, true); 
                $peoples = $array['data'];
                // Extracting row by row
                foreach($peoples as $row) {

                    // Database query to insert data 
                    // into database Make Multiple 
                    // Insert Query 
                    $query .=  "INSERT INTO players VALUES ('".$row["id"]."', '".$row["fullName"]."','".$row["nationality"]."'); "; 
   
                    $table_data .= '
                    <tr>
                        <td>'.$row["id"].'</td>
                        <td>'.$row["fullName"].'</td>
                        <td>'.$row["nationality"].'</td>
                    </tr>
                    '; // Data for display on Web page
                    }

    ///*
                if(mysqli_multi_query($connect, $query)) {
                    echo '<h3>Inserted JSON Data</h3><br />';
                    echo '
                    <table class="table table-bordered">
                    <tr>
                        <th width="45%">ID</th>
                        <th width="10%">Full Name</th>
                        <th width="45%">Nationality</th>
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