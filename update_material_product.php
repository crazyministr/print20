<?php
	$ch = $_GET['ch'];
	if ($ch == "disabled")
	{
            echo "<option value='paper'>Мелованная бумага</option>";
	}
	else if ($ch == "enabled")
	{
            echo "<option value='paper'>Мелованная бумага</option>";
            echo "<option value='carton'>Картон</option>";
            echo "<option value='offset'>Офсетная бумага</option>";
	}
        else if ($ch == "st")
        {
            echo "<option value='paper'>Самоклейка</option>";
        }
	else
	{
            echo "<option value='paper'>Мелованная бумага</option>";
            echo "<option value='offset'>Офсетная бумага</option>";
	}
?>
