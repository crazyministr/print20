<?php
	require_once 'save_materials.php';
	$ch = $_GET['ch'];
	for ($i = 0; $i < count($density[$ch]); $i++)
	{
		$w = $density[$ch][$i];
		echo "<option value='$w'>$w</option>";
	}
?>
