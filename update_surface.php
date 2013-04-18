<?php
	$ch = $_GET['ch'];
	if ($ch == 'paper')
	{
		echo "<option value='matted'>Матовая</option>";
        echo "<option value='glossy'>Глянцевая</option>";
	}
	else
		echo "";
?>
