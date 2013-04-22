<?php

$ch = $_GET['ch'];
if ($ch == "no") {
    echo "<input type='hidden' name='solid_cover_uf' id='solid_cover_uf' value=''>";
} else {
    echo "<input type='checkbox' name='solid_cover_uf' id='solid_cover_uf' value=''> Сплошной";
}
?>
