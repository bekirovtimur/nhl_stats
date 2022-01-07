<?php
// Connect to DB
include 'db_connect.php';
if (!$connect) {
 die("Ошибка: " . mysqli_connect_error());
 }

// Create table or truncate if exist
$table = 'countries';
$sql = "CREATE TABLE $table (
country VARCHAR(30),
city VARCHAR(70)
)";

if (mysqli_query($connect, $sql)) {
  echo "Table $table created successfully. ";
} else {
  echo "Error creating table: " . mysqli_error($connect) . " ";
  mysqli_query($connect, "TRUNCATE TABLE `$table`");
}

// Take info from API and put it to DB
$url = 'https://countriesnow.space/api/v0.1/countries';
$json = file_get_contents($url);
$array = json_decode($json, true);
$data = $array['data'];
foreach ($data as $countries){
  $country = $countries['country'];
  if($country == "Canada" || $country == "United States"){
    $cities = $countries['cities'];
    foreach ($cities as $city){
      echo $country."-".$city."|";
      var_dump($country);
      $query .=  "INSERT INTO $table VALUES ('".addslashes($country)."', '".addslashes($city)."'); ";
    }
  }
}


if(mysqli_multi_query($connect, $query)) {
    echo 'All OK!';
} else {
    echo "Error! " . mysqli_error($connect);
}
?>
