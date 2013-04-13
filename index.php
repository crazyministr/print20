<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Калькулятор</title>
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/calc.js"></script>

        <link rel="stylesheet" href="css/bootstrap.min.css"  media="screen">
        <link rel="stylesheet" href="css/bootstrap.css"  media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css"  media="screen">

    </head>
    <body>
    <center>
        <h2>Онлайн-калькулятор</h2>
        <?php
        require_once 'product.php';
        require_once 'array_to_xml.php';
        require_once 'execute_calc.php';
        require_once 'save_product.php';

        foreach ($_POST as $key => $value) {
            $post[$key] = $value;
//            echo $key . ' ' . $value . '<br>';
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
        if (is_writable($file_name)) {
            $handle = fopen($file_name, 'w');
            fwrite($handle, $xml);
            fclose($handle);
            echo "<a href=" . $file_name . ">Show Xml</a><br><br>";
            execute_calc("product");
        } else {
            echo 'File ' . $file_name . ' is unavailable for write';
        }
        ?>
    </center>
</form>
</body>
</html>
