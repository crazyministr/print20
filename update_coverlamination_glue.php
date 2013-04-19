<?php
	$ch = $_GET['ch'];
	if ($ch == "Booklet_(termo-glue)")
	{
		echo "<option value='no'>Без ламинации</option>";
		echo "<option value='one matted'>Односторонняя матовая</option>";
		echo "<option value='one glossy'>Односторонняя глянцевая</option>";
	}
	else
	{
        echo "<option value='no'>Без ламинации</option>";
        echo "<option value='one matted'>Односторонняя матовая</option>";
        echo "<option value='one glossy'>Односторонняя глянцевая</option>";
        echo "<option value='two matted'>Двусторонняя матовая</option>";
        echo "<option value='two glossy'>Двусторонняя глянцевая</option>";		
	}
?>
