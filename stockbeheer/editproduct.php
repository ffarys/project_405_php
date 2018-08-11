<?php
include 'routines/connect.php';
include 'routines/constants.php';
    

// default values
// default waarden
$barcode = "";
$name = "";
$oper = $cmd_create_product;
if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($_GET)>0) {
    if (array_key_exists("barcode", $_GET)) {
        // als een id wordt meegegeven, laadt de waarden om te editeren.
        $barcode = $_GET["barcode"];
        $result = $connection->query("SELECT * FROM products WHERE barcode=". $barcode);
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $oper = $cmd_change_product;
    }
    $typeid = $_GET["typeid"];
} else {
    die ("Product heeft type-id nodig.");
}

echo "<h1>Product ";
if ($oper == $cmd_change_product) {
    echo "wijzigen";
} else {
    echo "toevoegen";
}
echo "</h1>";

echo "<form action='editproducttype.php' method='post'>\n";
echo "<input type='hidden' name='id' value='". $typeid. "'/>\n";
echo "<strong>Naam: *</strong> <input type='text' name='name' value='". $name. "'/><br/>\n";
echo "<strong>Barcode: *</strong> <input type='text' name='barcode' value='". $barcode. "'";
if ($oper == $cmd_change_product) {
    echo " readonly";
}
echo "/><br/>\n";

echo "<button type='submit' name='". $oper. "' value='". $barcode. "'>OK</button>\n";
echo "<button type='submit' name='nop' value='nop'>Annuleren</button>\n";
if ($oper == $cmd_change_product) {
    echo "<button type='submit' name='" . $cmd_remove_product. "' value='". $barcode. "'>Verwijderen</button>\n";
}

echo "</form>";
include 'routines/disconnect.php';

?>