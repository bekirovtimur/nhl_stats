<?php
include 'db_conf.php';
$check_conn = mysqli_connect($db_server, $db_username, $db_password); 
$check_query = "USE $db_name";
if (mysqli_query($check_conn, $check_query))
  {
    $connect = mysqli_connect($db_server, $db_username, $db_password, $db_name); 
  }
else
  {
    die ("Error: " . mysqli_error($check_conn));
  }
if (!$connect) 
  {
    die("Error: " . mysqli_connect_error());
  }
?>
