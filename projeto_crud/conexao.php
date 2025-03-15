<?php

$host = 'localhost'; 
$dbname = 'db_produtos'; 
$username = 'root'; 
$password = ''; 

$conn = mysqli_connect($host, $username, $password, $dbname);


if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
} else {

}