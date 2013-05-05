        <?php
        require_once 'product.php';
        require_once 'array_to_xml.php';
        require_once 'execute_calc.php';
        require_once 'save_product.php';
        require_once 'xml2array.php';


        foreach ($_POST as $key => $value) {
            $post[$key] = $value;
           echo $key . ' ' . $value . '<br>';
        }
        $temp_str = $_POST['choose-product'];
        for ($i = 0; $i < strlen($temp_str); $i++)
            if ($temp_str[$i] == '_')
                $temp_str[$i] = ' ';

        $post['json-product'] = (array) $prod[$post['choose-product']];

        $post['choose-product'] = $temp_str;

        $product = new product($post);

        $converter = new array_to_xml();
        $xml = $converter->convert($product->get_array());

        $file_name = 'input/product.xml';
        if (!is_writable($file_name)) {
            exit('File ' . $file_name . ' is unavailable for write');
        }
        $handle = fopen($file_name, 'w');
        fwrite($handle, $xml);
        fclose($handle);
        
	$calc_out = execute_calc("product");
        $handle = fopen('output/productOut.xml', 'r');
	$productOut = '';
        while (!feof($handle)) {
            $productOut .= fgets($handle);
        }
        fclose($handle);
        $res = xml2array($productOut);
	//var_dump($res);
	$product_name = $post['json-product']['name_ru'];
	$product_circulation = $post['circulation'];
	$total_cost = $res[0]['attrs']['TOTAL'];
	echo "Вы хотите сделать заказ " . $product_name . " тиражом в " . $product_circulation . " шт.<br>";
	echo "Итого: " . $total_cost . "<br>";
	echo "<br>";
	echo "<a href=" . $file_name . ">input Xml</a><br><br>";
        echo "<a href=output/productOut.xml>output Xml</a><br><br>";
	//$comment = $post['comment'];
        ?>
