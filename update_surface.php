<?php
	$ch = $_GET['ch'];
	if ($ch == 'paper')
	{
		echo "<option value='matted'>Матовое</option>";
        echo "<option value='glossy'>Глянцевое</option>";
	}
	else
		echo "";
?>
