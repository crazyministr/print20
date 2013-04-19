$(document).ready(function() {
    var chooseProduct = $('#choose-product');
    var formatProduct = $('#format-product');
    var material = $('#material');
    var predV = 0;

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
            alert('Неверный формат продукта');
    })

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
            var v = $('#cover').val();
            if (v == 1)
                alert("ВНИМАНИЕ! СКРЕПЛЕНИЕ ПРОИЗВОДИТЬСЯ ПО ВЫСОТЕ");

            if (v == 1 && predV != v)
            {
                $('.postprint').toggleClass("span6");
                $('.postprint').toggleClass("span10");
                $('.fourth').show();
                $('.sixth').show();
            }
            else if (v == 0 && predV != v)
            {
                $('.postprint').toggleClass("span6");
                $('.postprint').toggleClass("span10");
                $('.fourth').hide();
                $('.sixth').hide();
            }
            if (v == 1)
                $('#cover').attr('checked', 'checked');
            else
                $('#cover').removeAttr('checked');
            predV = v;
        });

        
        $('#cover-lamination').load("update_lamination_glue.php?ch=" + x);

        if (x == 'Kubarik')
        {
            $('#material').load("update_material_product.php?ch=" + "disabled");
            $('#density').load("update_kubarik_density.php?ch=" + 150);
        }
        else
        {
            $('#material').load("update_material_product.php?ch=" + "enabled");
            $('#density').load("update_kubarik_density.php?ch=" + 1000);
        }

        formatProduct.load("update_format_product.php?ch=" + x, function() {
            var product_format = $(this).val();
            var product_width = '';
            var product_height = '';
            var a = product_format.split('x');
            if (($.isNumeric(a[0])) && ($.isNumeric(a[1])))
            {
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
        $('#surface').load("update_surface.php?ch=" + x, function(){
            if (x != 'paper')
                $('#surface').attr('disabled', 'disabled');
            else
                $('#surface').removeAttr('disabled');
        });
    });
    material.change();

    // свой формат
    $('#new_format').change(function() {
        if ($('#new_format').is(':checked'))
        {
            $('#format-width, #format-height').removeAttr("disabled");
            formatProduct.attr("disabled", "disabled");
        }
        else
        {
            $('#format-width, #format-height').attr("disabled", "disabled");
            formatProduct.removeAttr("disabled");
            formatProduct.change();
            _upd_formats();
        }
    })

    $('#lamination').change(function() {
        var v = $(this).val();
        var a = v.split(' ');
        if (a[0] != 'no' && a[1] == 'glossy')
        {
            $('#uf').attr('disabled', 'disabled');
            $('#choose_uf').attr('disabled', 'disabled');
            $('#impression-width, #impression-height, #impression-times').removeAttr("disabled");
        }
        else
        {
            $('#uf').removeAttr('disabled');
            $('#choose_uf').removeAttr('disabled');
            $('#impression-width, #impression-height, #impression-times').attr("disabled", "disabled");
        }
    });

    $('#cover-lamination').change(function() {
        var v = $(this).val();
        var a = v.split(' ');
        if (a[0] != 'no' && a[1] == 'glossy')
        {
            $('#cover-uf').attr('disabled', 'disabled');
            $('#choose_cover-uf').attr('disabled', 'disabled');
        }
        else
        {
            $('#cover-uf').removeAttr('disabled');
            $('#choose_cover-uf').removeAttr('disabled');
        }
    });

    $('#choose_uf').change(function(){
        if ($('#choose_uf').is(':checked'))
            $('#impression-width, #impression-height, #impression-times').removeAttr("disabled");
        else
            $('#impression-width, #impression-height, #impression-times').attr("disabled", "disabled");
    })
    $('#choose_uf').change();

    $('form').submit(function() {
        var circulation = document.forms[0].circulation.value;
        if (circulation == 0)
        {
            alert("Тираж должен быть больше нуля");
            document.forms[0].circulation.focus();
            return false;
        }

        var v = document.forms[0].pages.value;
        var x = chooseProduct.val();
        if (v == 0 || v % 2 != 0)
        {
            if (v == 0)
                alert("Количество полос в блоке должно быть больше нуля");
            else
            {
                if (x == "Booklet_(brace)")
                    alert("Количество полос в блоке данного продукта должно быть кратно четырём");
                else
                    alert("Количество полос в блоке данного продукта должно быть кратно двум");
            }
            document.forms[0].pages.focus();
            return false;
        }
        formatProduct.removeAttr('disabled');
        $('#format-width, #format-height').removeAttr('disabled');
        $('#pages').removeAttr('disabled');
        $('#cover-pages').removeAttr('disabled');
        return true;
    })
})
