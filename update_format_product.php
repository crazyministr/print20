<?php
	require_once 'save_product.php';
	$ch = $_GET['ch'];
	$cnt = count($prod[$ch]->formats);
    for ($i = 0; $i < $cnt; $i++)
    {
        $w = $prod[$ch]->formats[$i];
        echo "<option value=".$w.">".$w."</option>";
    }
?>
