<?php
include 'routines/connect.php';
include 'routines/constants.php';
include 'routines/producttype_actions.php';

$result = $connection->query( "SELECT * FROM producttypes WHERE stock < reorderlevel ORDER BY name");
$resultJSON = array();
while($row = $result->fetch_assoc()) {
    $resultJSON [] = $row;
}
echo json_encode($resultJSON);