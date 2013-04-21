<?php

$ch = $_GET['ch'];
if ($ch == "no") {
    echo "<input type='hidden' name='solid_uf' id='solid_uf' value=''>";
} else {
    echo "<input type='checkbox' name='solid_uf' id='solid_uf' value=''> Сплошной";
}
?>
