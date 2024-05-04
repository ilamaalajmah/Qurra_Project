<?php

$host = "localhost";
$dbname = "library";
$dbuser = "root";
$dbpas = "";


try{
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpas);
}catch(Exception $e){
    echo "". $e->getMessage();
}
