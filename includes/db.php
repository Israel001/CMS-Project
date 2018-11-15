<?php

$db['db_server'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if($connection->connect_error){
    die("Connection Failed: ".mysqli_connect_error());
}

$query = "SET NAMES utf8";
mysqli_query($connection, $query);

?>
