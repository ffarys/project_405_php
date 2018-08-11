<?php
include 'routines/connect.php';
include 'routines/constants.php';
include 'routines/producttype_actions.php';

if ($id == $id_not_found && isset($barcode)) {
    echo "<strong>Opgelet: product met barcode ".$barcode." werd niet gevonden.</strong></br>";
}

// output (huidige status van de stock)
$result = $connection->query( "SELECT * FROM producttypes ORDER BY name" );
echo "<a href='editproducttype.php'>Nieuw producttype toevoegen.</a>";
echo "<form action='stock.php' method='get'>";
if ($result->num_rows > 0) {
    echo"<table border='1'>";
    echo"<tr><th>ID</th><th>Naam</th><th>Stock</th><th>Min</th><th>Acties</th></tr>\n";
    while($row = $result->fetch_assoc()) {
        if ($row['id'] == $id) {
            echo "<tr bgcolor='#bfff00'>";
        } else {
            echo "<tr>";
        }
        echo "<td>{$row['id']}</td>";
        echo "<td><a href='editproducttype.php?id={$row['id']}'>{$row['name']}</a></td>";
        echo "<td>{$row['stock']}</td>";
        if ($row['reorderlevel'] > $row['stock']) {
            echo "<td bgcolor='SALMON'>{$row['reorderlevel']}</td>";
        } else {
            echo "<td>{$row['reorderlevel']}</td>";
        }
        echo "<td><button type='submit' value='{$row['id']}' name='{$cmd_add_stock}'>+</button>";
        
        echo "<button type='submit' value='{$row['id']}' name='{$cmd_subtract_stock}'>-</button></td>";
        echo "</tr>\n";
    }
    echo"</table>";
} else {
    echo "geen producten gevonden";
}
echo "</form>";
include 'routines/disconnect.php';

?>