<?php
$host="localhost";
$dbname="lapyae";
$username = "root";
$password = "Hello*111#";
$db_option =[
    PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
];

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname",$username,$password,$db_option);
} catch (Exception $th) {
    echo  $th->getMessage();
}?>