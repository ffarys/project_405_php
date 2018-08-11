<?php 
include 'routines/connect.php';
include 'routines/constants.php';
include 'routines/product_actions.php';

echo "<h1>Producttype ";
if ($id >= 0) {
    echo "toevoegen";
} else {
    echo "wijzigen"; 
}
echo "</h1>";

echo "<form action='stock.php' method='post'>";
echo "<strong>Naam: *</strong> <input type='text' name='name' value='". $name. "'/><br/>";
echo "<strong>Stock: *</strong> <input type='number' name='stock' value='". $stock. "'/><br/>";
echo "<strong>Min. stock: *</strong> <input type='number' name='reorderlevel' value='". $reorderlevel. "'/><br/>";

echo "<button type='submit' name='". $oper. "' value='". $id. "'>OK</button>";
echo "<button type='submit' name='nop' value='nop'>Annuleren</button>";
if ($id >= 0) {
    echo "<button type='submit' name='" . $cmd_remove_type. "' value='". $id. "'>Verwijderen</button>";
}

echo "</form>";

if ($id >= 0) {
    echo "<h2>Producten:</h2>";
    echo "<a href='editproduct.php?typeid={$id}'>Nieuw product toevoegen.</a>";
    $result = $connection->query("SELECT * FROM products WHERE ptype=". $id. " ORDER BY name");
    if ($result->num_rows > 0) {
        echo"<table border='1'>";
        echo"<tr><th>Naam</th><th>Barcode</th></tr>\n";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><a href='editproduct.php?barcode={$row['barcode']}&typeid={$id}'>{$row['name']}</a></td>";
            echo "<td>{$row['barcode']}</td>";
            echo "</tr>\n";
        }
        echo"</table>";
    } else {
        echo "geen producten gevonden";
    }
    
}

include "routines/disconnect.php";
?>
