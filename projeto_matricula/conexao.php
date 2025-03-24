<?php

$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "db_cursos";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){

    die('falha na conexão:' . $conn->connect_error);
} 