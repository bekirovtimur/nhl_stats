<?php
 $connect = mysqli_connect("mysql", "root", "root", "nhl"); 
 $query = '';
 if (!$connect) {
 die("Error: " . mysqli_connect_error());
 }
 ?>
