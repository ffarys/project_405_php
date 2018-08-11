<?php
include 'routines/connect.php';
include 'routines/constants.php';
include 'routines/producttype_actions.php';
include 'routines/search_barcode.php';

$jsonResult = new \stdClass();
if ($id == $id_not_specified) {
    $jsonResult->message="Geen producttype gespecifieerd.";
    $jsonResult->error=1;
    $jsonResult->request=http_build_query($_REQUEST);
} elseif ($id == $id_not_found) {
    $jsonResult->message="Producttype niet gekend.";
    $jsonResult->error=1;
    $jsonResult->websearch=searchbarcode($barcode);
} else {
    $result = $connection->query( "SELECT * FROM producttypes WHERE id=".$id );
    $row = $result->fetch_assoc();
    $jsonResult->error=0;
    $jsonResult->name=$productname;
    $jsonResult->type=$row["name"];
    $jsonResult->stock=$row["stock"];
    $jsonResult->reorderlevel=$row["reorderlevel"];
    $jsonResult->message="Product '".$row["name"]."' stock: ".$row["stock"];
 }
 echo json_encode($jsonResult);