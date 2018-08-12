<?php
$id = $id_not_specified;  #  niet gespecifieerd
$productname = "";   #  niet gespecifieerd
if (($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST')
    && count($_REQUEST)>0) {
        if (array_key_exists($cmd_barcode, $_REQUEST)) {
            $barcode = $_REQUEST[$cmd_barcode];
            $result = $connection->query("SELECT ptype, name FROM products WHERE barcode=". $barcode);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id = $row["ptype"];
                $productname = $row["name"];
            } else {
                $id = $id_not_found;   #  niet gevonden
            }
            // vertaal paramter 'action' naar een command.
            if (array_key_exists("action", $_REQUEST)) {
                if ($_REQUEST["action"] == $cmd_add_stock) {
                    $connection->query("UPDATE producttypes SET stock=stock+1 WHERE id=". $id);
                } elseif ($_REQUEST["action"] == $cmd_subtract_stock) {
                    $connection->query("UPDATE producttypes SET stock=stock-1 WHERE id=". $id.
                        " AND stock > 0");
                }
            }
        }
        if (array_key_exists($cmd_get_stock, $_REQUEST)) {
            $id = $_REQUEST[$cmd_get_stock];
        }
        if (array_key_exists($cmd_add_stock, $_REQUEST)) {
            $id = $_REQUEST[$cmd_add_stock];
            $connection->query("UPDATE producttypes SET stock=stock+1 WHERE id=". $id);
            
        }
        if (array_key_exists($cmd_subtract_stock, $_REQUEST)) {
            $id = $_REQUEST[$cmd_subtract_stock];
            $connection->query("UPDATE producttypes SET stock=stock-1 WHERE id=". $id.
                " AND stock > 0");
        }
        if (array_key_exists($cmd_change_type, $_REQUEST)) {
            $id = $_REQUEST[$cmd_change_type];
            $name = $_REQUEST["name"];
            $stock = $_REQUEST["stock"];
            $reorderlevel = $_REQUEST["reorderlevel"];
            $connection->query("UPDATE producttypes SET name='". $name."', stock=". $stock.
                ", reorderlevel=". $reorderlevel. " WHERE id=". $id);
        }
        if (array_key_exists($cmd_create_type, $_REQUEST)) {
            $name = $_REQUEST["name"];
            $stock = $_REQUEST["stock"];
            $reorderlevel = $_REQUEST["reorderlevel"];
            $connection->query("INSERT INTO producttypes (name, stock, reorderlevel) VALUES ('"
                . $name."', ". $stock.", ". $reorderlevel. ")");
        }
        if (array_key_exists($cmd_remove_type, $_REQUEST)) {
            $id = $_REQUEST[$cmd_remove_type];
            $connection->query("DELETE FROM products WHERE ptype=". $id);
            $connection->query("DELETE FROM producttypes WHERE id=". $id);
        }
    }
   ?>