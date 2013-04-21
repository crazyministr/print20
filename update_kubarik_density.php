<?php
	require_once 'save_materials.php';
	$ch = (int) $_GET['ch'];
	for ($i = 0; $i < count($density['paper']); $i++)
	{
		$w = $density['paper'][$i];
		if ($ch == 150 && (int) $w <= $ch || $ch == 170 && (int) $w >= $ch || $ch == 1000)
			echo "<option value='$w'>$w</option>";
	}
?>
