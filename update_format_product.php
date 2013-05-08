<?php

require_once 'save_product.php';
$ch = $_GET['ch'];
$cnt = count($prod[$ch]->formats);
for ($i = 0; $i < $cnt; $i++) {
    $w = $prod[$ch]->formats[$i];
    $t = explode("x", $w);
    $w = $t[1] . "x" . $t[0];
    echo "<option value=" . $w . ">" . $w . "</option>";
}
?>
