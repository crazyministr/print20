<?php
	require_once 'save_product.php';
	$ch = $_GET['ch'];
	if ($prod[$ch]->type != 'singlepage')
		echo "<input type='checkbox' name='cover' id='cover' value=''>Обложка из другого материала";
	else
		echo "";
?>
