<?php
$hostname = "diskstation";
$username = "id6659169_farys";
$password = "farys";
$dbname = "id6659169_storage";

$connection = new mysqli($hostname,$username,$password,$dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>