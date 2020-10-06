<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = 'Ab0938130702'; 
    $dbname = 'rock070';
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error) {
        echo '資料庫連結錯誤: ' . $conn->connect_error;
    }

    $conn->query("SET NAMES 'utf8'");
    $conn->query("SET time_zone = '+8:00'");
    
?>