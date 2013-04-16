<?php
	require_once 'save_product.php';
	$ch = $_GET['ch'];
	if ($prod[$ch]->type == 'singlepage')
	{
		$pages = $prod[$ch]->pages_on_spread;
		echo "<input type='text' style='width:157px' value='$pages' disabled><span style='color:grey'><p>шт.</p></span>";
	}
	else
		echo "<input type='text' maxlength='6' name='pages' id='pages' style='width:157px'><p>шт.</p>";
?>
