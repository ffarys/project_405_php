<?php

$jsonResult = new \stdClass();
$jsonResult->id = 1;
$jsonResult->name = "Test user";
echo json_encode($jsonResult);