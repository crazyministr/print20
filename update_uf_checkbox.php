<?php

$ch = $_GET['ch'];
if ($ch == "no") {
    echo "<input type='hidden' name='choose_uf' id='choose_uf' value=''>";
} else {
    echo "<input type='checkbox' name='choose_uf' id='choose_uf' value=''> Выборочный <br>";
}
?>
