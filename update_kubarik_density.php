<?php
	require_once 'save_materials.php';
	$ch = (int) $_GET['ch'];
	for ($i = 0; $i < count($density['paper']); $i++)
	{
		$w = $density['paper'][$i];
		if ((int) $w <= $ch)
			echo "<option value='$w'>$w</option>";
	}
?>
