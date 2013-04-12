<?php

require_once 'product.php';
require_once 'array_to_xml.php';

foreach ($_POST as $key => $value) {
    $post[$key] = $value;
}

echo "<table>";
foreach ($post as $key => $value) {
    echo "<tr><td>$key</td>&nbsp <td>$value</td></tr>";
}
echo "</table>";
echo '<br>';

$temp_str = $_POST['choose-product'];
for ($i = 0; $i < strlen($temp_str); $i++)
	if ($temp_str[$i] == '_')
		$temp_str[$i] = ' ';

$post['json-product'] = (array) $prod[$post['choose-product']];
$post['choose-product'] = $temp_str;

$product = new product($post);

$converter = new array_to_xml();
$xml = $converter->convert($product->get_array());

$file_name = 'product.xml';
if (is_writable($file_name)) {
    $handle = fopen($file_name, 'w');
    fwrite($handle, $xml);
    fclose($handle);
    echo '<a href="product.xml">Show Xml</a><br><br>';
} else {
    echo 'File ' . $file_name . ' is unavailable for write';
}
//var_dump($prod);
?>
