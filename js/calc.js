$(document).ready(function() {
    var chooseProduct = $('#choose-product');
    var formatProduct = $('#format-product');
    var material = $('#material');

    //скрываем раскрываем блок рассчета обложки
    var _cover = function()
    {
        $('#cover').change(function() {
            if ($('#cover').is(':checked')) {
                $('.postprint').toggleClass("span6");
                $('.postprint').toggleClass("span10");
                $('.fourth').show();
                $('.sixth').show();
            } else {
                $('.postprint').toggleClass("span6");
                $('.postprint').toggleClass("span10");
                $('.fourth').hide();
                $('.sixth').hide();
            }
        })
    }

    _cover();

    // свой формат
    $('#new_format').change(function() {
        if ($('#new_format').is(':checked')) {
//            $('#format-width, #format-height').removeAttr("disabled");
            $('.postprint').toggleClass("span6");
            $('.postprint').toggleClass("span10");
            $('.fourth').show();
            $('.sixth').show();
        }
        else {
//            $('#format-width, #format-height').attr("disabled", "disabled");
            $('.postprint').toggleClass("span6");
            $('.postprint').toggleClass("span10");
            $('.fourth').hide();
            $('.sixth').hide();
        }
    })


    // Поворачиваем продукт (меняем ширину и высоту в формате продукта) "кнопкой"
    $('#exchange').click(function() {
        var product_width = $('#format-width').val();
        var product_height = $('#format-height').val();

        // если значения ширины и высоты - числовые:
        if (($.isNumeric(product_width)) && ($.isNumeric(product_height))) {

            var tmp = product_height;
            product_height = product_width;
            product_width = tmp;

            $('#format-width').val(product_width);
            $('#format-height').val(product_height);
        }
        else
            alert('Введите число');
    })

    // // Поворачиваем продукт (меняем ширину и высоту в формате продукта) "чекбоксом"
    // $('#turn').change(function(){
    // 	var product_width = $('#format-width').val();
    // 	var product_height = $('#format-height').val();

    // 	// если значения ширины и высоты - числовые:
    // 	if(($.isNumeric(product_width)) && ($.isNumeric(product_height))){
    // 			var tmp = product_height;
    // 			product_height = product_width;
    // 			product_width = tmp;

    // 			$('#format-width').val(product_width);
    // 			$('#format-height').val(product_height);
    // 		}
    // 		else {
    // 		alert('Введите число');
    // 	}
    // }) 

    // При изменении поля формат продукта меняем значения полей "ширина" и "высота"

    var _upd_formats = function()
    {
        formatProduct.change(function() {
            var product_format = $(this).val();
            var product_width = '';
            var product_height = '';
            var a = product_format.split('x');
            $('#format-width').val(a[0]);
            $('#format-height').val(a[1]);
        })
    }

    _upd_formats();

    // при выборе другого продукта

    chooseProduct.change(function() {
        var x = chooseProduct.val();
        $('#checkbox').load("update_cover.php?ch=" + x, function() {
            _cover();
            $('.fourth').hide();
            $('.sixth').hide();
        });

        formatProduct.load("update_format_product.php?ch=" + x, function() {
            var product_format = $(this).val();
            var product_width = '';
            var product_height = '';
            var a = product_format.split('x');
            if (($.isNumeric(a[0])) && ($.isNumeric(a[1]))) {
                $('#format-width').val(a[0]);
                $('#format-height').val(a[1]);
            }
            else
            {
                $('#format-width').val('');
                $('#format-height').val('');
            }

            if (formatProduct.children().length < 2)
                formatProduct.attr('disabled', 'disabled');
            else
                formatProduct.removeAttr('disabled');
        });

        $('#page').load("update_pages.php?ch=" + x);
    })
    chooseProduct.change();

    material.change(function() {
        var x = material.val();
        $('#density').load("update_density.php?ch=" + x);
    });
    material.change();

    $('form').submit(function() {
        formatProduct.removeAttr('disabled');
        $('#format-width, #format-height').removeAttr('disabled');
        $('#pages').removeAttr('disabled');
    })
})
