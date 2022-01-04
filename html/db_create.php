<?php
$conn = mysqli_connect("mysql", "root", "root");
if (!$conn) {
  die("Ошибка: " . mysqli_connect_error());
} 
// Создаем базу данных testdb
$sql = "CREATE DATABASE testdb";
if(mysqli_query($conn, $sql)){
    echo "База данных успешно создана";
} else{
    echo "Ошибка: " . mysqli_error($conn);
}
mysqli_close($conn);
?>