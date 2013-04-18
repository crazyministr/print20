<?php
	require_once 'save_product.php';
	$ch = $_GET['ch'];
	if ($prod[$ch]->type != 'singlepage')
		echo "<input type='hidden' name='cover' id='cover' value='1'>";
	else
		echo "<input type='hidden' name='cover' id='cover' value='0'>";
?>
