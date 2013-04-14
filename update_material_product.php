<?php
	$ch = $_GET['ch'];
	if ($ch == "disabled")
	{
		echo "<option value='paper'>Бумага</option>";
	}
	else
	{
		echo "<option value='paper'>Бумага</option>";
        echo "<option value='carton'>Картон</option>";
        echo "<option value='offset'>Оффсет</option>";
	}
?>
