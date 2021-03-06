<?php
require_once 'save_product.php';
require_once 'save_materials.php';
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Калькулятор</title>
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/calc.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>

        <link rel="stylesheet" href="css/bootstrap.min.css"  media="screen">
        <link rel="stylesheet" href="css/bootstrap.css"  media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css"  media="screen">

    </head>
    <body>
        <form action="" method="post">
            <div class="container">
                <div class="row">
                    <div class="span9" style="text-align:center;">
                        <h2>Онлайн-калькулятор</h2>
                        <label class="checkbox" id="checkbox"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="span6" id="first-param">
                        <div class="row">
                            <div class="span1 help-calc"></div>
                            <div class="span2" style="width:150px; margin-left:10px;"><label for="choose-product">Выберите продукт:</label></div>
                            <div class="span3">
                                <select name="choose-product" id="choose-product" style="width:170px; float:left;">
                                    <?php
                                    foreach ($prod as $key => $value)
                                        echo "<option value=" . $key . ">" . $value->name_ru . "</option>";
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span1 help-calc"></div>
                            <div class="span2" style="width:150px; margin-left:10px;">
                                <label for="circulation">Тираж:</label>
                            </div>
                            <div class="span3">
                                <input name="circulation" type="text" maxlength="8" id="circulation" style="width:157px;" pattern="^[0-9]+$"><p>шт.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span1 help-calc"></div>
                            <div class="span2" style="width:150px; margin-left:10px;"><label for="format-product">Формат продукции:</label></div>
                            <div class="span3" id="div_format_product">                               
                                <select name="format-product" id="format-product" style="width:170px; float:left;"></select>
                                <label class="checkbox" style="margin-left:16px;">
                                    <input type="checkbox" name="new_format" id="new_format" value=""> Свой формат
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span1 help-calc"></div>
                            <div class="span2" style="width:158px; margin-left:10px;">
                                <label for="format-width">Ширина:</label>
                                <input type="text" maxlength="3" name="format-height" id="format-height" style="width:50px" value="" disabled pattern="^[ 0-9]+$"><p>мм</p>
                            </div>
                            <div class="span1" style="width:40px; margin-left:10px;" title="Повернуть">
                                <button class="btn" type="button" id="exchange"><i class="icon-exchange icon-1.5x"></i></button>
                            </div>
                            <div class="span2" style="width:162px; margin-left:13px;">
                                <label for="format-height">Высота:</label>
                                <input type="text" maxlength="3" name="format-width" id="format-width" style="width:50px" value="" disabled pattern="^[ 0-9]+$"><p>мм</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span6" id="second-param">
                        <div class="row">
                            <div class="span6">
                                <p style="text-align:center; font-weight:bold;">Продукт</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span1 help-calc"></div>
                            <div class="span2" style="width:150px; margin-left:10px;"><label for="pages">Количество полос:</label></div>
                            <div class="span3" id="page">
                                <input type="text" maxlength="6" name="pages" id="pages" style="width:167px">
                            </div>
                        </div>
                        <div class="row">
                            <div class="span1 help-calc"></div>
                            <div class="span2" style="width:150px; margin-left:10px;"><label for="chromacity">Цветность:</label></div>
                            <div class="span3">
                                <select name="chromacity" id="chromacity" style="width:180px; float:left;">
                                    <option value="4x4">4x4</option>
                                    <option value="4x1">4x1</option>
                                    <option value="4x0">4x0</option>
                                    <option value="1x1">1x1</option>
                                    <option value="1x0">1x0</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span1 help-calc"></div>
                            <div class="span2" style="width:150px; margin-left:10px;"><label for="material">Выберите материал:</label></div>
                            <div class="span3">
                                <select name="type" id="material" style="width:180px; float:left;">
                                    <option value="paper">Мелованная бумага</option>
                                    <option value="carton">Картон</option>
                                    <option value="offset">Офсетная бумага</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span1 help-calc"></div>
                            <div class="span2" style="width:150px; margin-left:10px;"><label for="glossy">Выберите покрытие:</label></div>
                            <div class="span3">                               
                                <select name="surface" id="surface" style="width:180px; float:left;">
                                    <option value="matted">Матовая</option>
                                    <option value="glossy">Глянцевая</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span1 help-calc"></div>
                            <div class="span2" style="width:150px; margin-left:10px;"><label for="density">Плотность:</label></div>
                            <div class="span3">
                                <select name="density" id="density" style="width:180px; float:left;"></select>
                                <p>г/м<sup>2</sup></p>
                            </div>
                        </div>
                    </div>
                    <div class="span3 fourth" style="display:none;" id="fourth-param">
                        <p style="text-align:center; font-weight:bold;">Обложка</p>
                        <div class="row">
                            <div class="span3"><input type="text" maxlength="6" name="cover-pages" id="cover-pages" style="width:157px" value="4" disabled></div> 
                        </div>
                        <div class="row">
                            <div class="span3">
                                <select name="cover-chromacity" id="cover-chromacity" style="width:170px;">
                                    <option value="4x4">4x4</option>
                                    <option value="4x1">4x1</option>
                                    <option value="4x0">4x0</option>
                                    <option value="1x1">1x1</option>
                                    <option value="1x0">1x0</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span3">
                                <select name="cover-type" id="cover-material" style="width:170px;">
                                    <option value="paper">Мелованная бумага</option>
                                    <option value="carton">Картон</option>
                                    <option value="offset">Офсетная бумага</option>
                                </select>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="span3">
                                <select name="cover-surface" id="cover-surface" style="width:170px;">
                                    <option value="matted">Матовая</option>
                                    <option value="glossy">Глянцевая</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span3">
                                <select name="cover-density" id="cover-density" style="width:170px; float:left;"></select>
                                <p>г/м<sup>2</sup></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span6 postprint">
                        <p style="text-align:center; font-weight:bold;">Доступные постпечатные операции</p>
                        <div class="row">
                            <div class="span6" id="fifth-param">
                                <p style="text-align:center; font-weight:bold;">Продукт</p>
                                <div class="row">
                                    <div class="span1 help-calc">
                                    </div>
                                    <div class="span2" style="width:150px; margin-left:10px;"><label for="vd">Покрытие ВД-лаком:</label></div>
                                    <div class="span3">
                                        <select name="vd" id="vd" style="width:170px;"></select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="span1 help-calc"></div>
                                    <div class="span2" style="width:150px; margin-left:10px;"><label for="lamination">Ламинация 25 мкм:</label></div>
                                    <div class="span3">
                                        <select name="lamination" id="lamination" style="width:170px;" disabled="disabled"></select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="span1 help-calc"></div>
                                    <div class="span2" style="width:150px; margin-left:10px;"><label for="uf">Покрытие УФ-лаком:</label></div>
                                    <div class="span3">
                                        <select name="uf" id="uf" style="width:170px;"></select>
                                        <br>
                                        <label class="checkbox" style="margin-left:16px;" id="uf_checkbox">
                                            <input type="hidden" name="choose_uf" id="choose_uf" value="" disabled="disabled">
                                        </label>
                                        <!--                                         <label class="checkbox" style="margin-left:16px;" id="solid_checkbox">
                                                                                    <input type="hidden" name="solid_uf" id="solid_uf" value="" disabled="disabled"> 
                                                                                </label>
                                        -->                                    </div>
                                </div>
                            </div>
                            <div class="span3 fourth" style="display:none; min-height:185px;" id="sixth-param">
                                <p style="text-align:center; font-weight:bold;">Обложка</p>
                                <div class="row">
                                    <div class="span3">
                                        <select name="cover-vd" id="cover-vd" style="width:170px;"></select>
                                    </div>    
                                </div>
                                <div class="row">
                                    <div class="span3">
                                        <select name="cover-lamination" id="cover-lamination" style="width:170px;"></select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="span3">
                                        <select name="cover-uf" id="cover-uf" style="width:170px;"></select>
                                        <br>
                                        <label class="checkbox" style="margin-left:1px;" id="cover_uf_checkbox">
                                            <input type="hidden" name="choose_cover_uf" id="choose_cover_uf" value=""> 
                                        </label>
                                        <!--                                         <label class="checkbox" style="margin-left:16px;" id="cover_solid_checkbox">
                                                                                    <input type="hidden" name="solid_cover_uf" id="solid_cover_uf" value="" disabled="disabled"> 
                                                                                </label>
                                        -->                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <br>
            <center>
                <input type="button" id="Calculate" onclick="send();" value="Calculate"/>
                <br>
                <div class="row">
                    <div class="span3" id="seven" style="min-height:80px; min-width:460px;">
                        <p style="text-align:center; font-weight:bold;">Комментарии к заказу</p>
                        <textarea id="comment" name="comment" rows="3" style="width:425px; margin-left:10px;"></textarea>
                    </div>
                </div>
            </center>
        </form>
        <div id="result"></div>
    </body>
</html>
