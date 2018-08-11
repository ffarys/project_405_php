<?php

function searchbarcode($barcode) {
    $url = "http://product-open-data.com/gtin/".$barcode."?format=json";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);
    $s = curl_exec($ch);
    $err = curl_errno($ch);
    curl_close($ch);
    if($err){
        return "";
    } else {
        $result = "";
        preg_match("/Brand name.+\\<a.+\\>(.*)<\\/a/", $s, $matches);
        if (array_key_exists(1, $matches)) {
            $result = $result. $matches[1];
        }
        preg_match("/Commercial name.+:(.*)<br/", $s, $matches);
        if (array_key_exists(1, $matches)) {
            $result = $result. $matches[1];
        }
        return $result;
    }
}