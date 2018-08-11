<?php
$oper = $cmd_create_type;
if (($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST')
    && count($_REQUEST)>0 && array_key_exists("id", $_REQUEST)) {
        // als een id wordt meegegeven, laadt de waarden om te editeren.
        $id = $_REQUEST["id"];
        $result = $connection->query("SELECT * FROM producttypes WHERE id=". $id);
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $stock = $row["stock"];
        $reorderlevel = $row["reorderlevel"];
        $oper = $cmd_change_type;
        if (array_key_exists($cmd_change_product, $_REQUEST)) {
            $barcode = $_POST["barcode"];
            $pname = $_POST["name"];
            $connection->query("UPDATE products SET name='". $pname."' WHERE barcode='". $barcode."'");
        }
        if (array_key_exists($cmd_create_product, $_REQUEST)) {
            $barcode = $_POST["barcode"];
            $pname = $_POST["name"];
            $query = "INSERT INTO products (barcode, name, ptype) VALUES ('"
                . $barcode."', ". $pname.", ". $id. ")";
                $connection->query("INSERT INTO products (barcode, name, ptype) VALUES ('"
                    . $barcode."', '". $pname."', ". $id. ")");
        }
        if (array_key_exists($cmd_remove_product, $_REQUEST)) {
            $barcode = $_POST["barcode"];
            $connection->query("DELETE FROM products WHERE barcode=". $barcode);
        }
    } else {
        // default waarden
        $id = $id_not_specified;
        $name = "";
        $stock = 0;
        $reorderlevel = 0;
    }
  ?>