$(document).ready(function() {
    var chooseProduct = $('#choose-product');
    var formatProduct = $('#format-product');
    var material = $('#material');
    var predV = 0;
    var cover_material = $('#cover-material');

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
            var a = product_format.split('x');
            $('#format-width').val(a[1]);
            $('#format-height').val(a[0]);
        })
    }

    _upd_formats();

    // при выборе другого продукта

    chooseProduct.change(function() {
        $('#vd').load("default_vd.php");
        $('#lamination').load("default_lamination.php");
        $('#uf').load("default_uf.php", function() {
            $('#uf').change();
        });
        $('#cover-vd').load("default_vd.php");
        $('#cover-lamination').load("default_lamination.php");
        $('#cover-uf').load("default_uf.php", function() {
            $('#cover-uf').change();
        });
        $('#new_format').removeAttr('checked');
        $('#new_format').change();
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

        $('#cover-lamination').load("update_coverlamination_glue.php?ch=" + x);
        $('#lamination').load("update_lamination_glue.php?ch=" + x, function() {
            if (x == "Booklet_(termo-glue)")
            {
                $('#lamination').load("default_lamination.php", function() {
                    $('#lamination').attr('disabled', 'disabled');
                });
            }
            else
                $('#lamination').removeAttr('disabled');
        });

        if (x == 'Booklet_(termo-glue)')
        {
            $('#material').load("update_material_product.php?ch=" + "enabledX");
            var t = material.val();
            $('#density').load("update_glue_density.php?ch=" + t);
            $('#cover-material').load("update_material_product.php?ch=" + "disabled");
            $('#cover-density').load("update_kubarik_density.php?ch=" + 170);
        }
        else if (x == 'Booklet_(brace)')
        {
            $('#material').load("update_material_product.php?ch=" + "enabledX");
            $('#density').load("update_kubarik_density.php?ch=" + 1000);
        }
        else if (x == 'Kubarik')
        {
            $('#material').load("update_material_product.php?ch=" + "disabled");
            $('#density').load("update_kubarik_density.php?ch=" + 150);
        }
        else
        {
            $('#material').load("update_material_product.php?ch=" + "enabled");
            $('#density').load("update_kubarik_density.php?ch=" + 1000);
        }
        if (x != 'Booklet_(termo-glue)')
        {
            $('#cover-material').load("update_material_product.php?ch=" + "enabled");
            $('#cover-density').load("update_kubarik_density.php?ch=" + 1000);
        }
        if (x == 'Eurobuklet' || x == 'Booklet' || x == 'Booklet_3'){
            alert("Внимание фальцовка производиться параллельно высоте изделия!");
        }

        formatProduct.load("update_format_product.php?ch=" + x, function() {
            var product_format = $(this).val();
            var a = product_format.split('x');
            $('#format-width').val(a[1]);
            $('#format-height').val(a[0]);
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
        $('#surface').load("update_surface.php?ch=" + x, function() {
            if (x != 'paper')
                $('#surface').attr('disabled', 'disabled');
            else
                $('#surface').removeAttr('disabled');
        });
        if (x == 'offset')
        {
            $('#lamination').load("default_lamination.php", function() {
                $('#lamination').attr('disabled', 'disabled');
            });
            $('#uf').load("default_uf.php", function() {
                $('#uf').change();
                $('#uf').attr('disabled', 'disabled');
            });
        }
        else
        {
            $('#lamination').removeAttr('disabled', 'disabled');
            $('#uf').removeAttr('disabled', 'disabled');
        }
        var xx = chooseProduct.val();
        if (xx == 'Booklet_(termo-glue)')
        {
            $('#lamination').load("default_lamination.php", function() {
                $('#lamination').attr('disabled', 'disabled');
            });
            $('#uf').load("default_uf.php", function() {
                $('#uf').change();
                $('#uf').attr('disabled', 'disabled');
            });
            $('#density').load("update_glue_density.php?ch=" + x);
        }
        else
        {
            $('#density').load("update_kubarik_density.php?ch=" + 1000);
        }
    });
    material.change();

    cover_material.change(function() {
        var x = cover_material.val();
        $('#cover-density').load("update_density.php?ch=" + x);
        $('#cover-surface').load("update_surface.php?ch=" + x, function() {
            if (x != 'paper')
                $('#cover-surface').attr('disabled', 'disabled');
            else
                $('#cover-surface').removeAttr('disabled');
        });
        if (x == 'offset')
        {
            $('#cover-lamination').load("default_lamination.php", function() {
                $('#cover-lamination').attr('disabled', 'disabled');
            });
            $('#cover-uf').load("default_uf.php", function() {
                $('#cover-uf').change();
                $('#cover-uf').attr('disabled', 'disabled');
            });
        }
        else
        {
            $('#cover-lamination').removeAttr('disabled', 'disabled');
            $('#cover-uf').removeAttr('disabled', 'disabled');
        }
    });
    cover_material.change();

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
            $('#uf').load("default_uf.php", function() {
                $('#uf').change();
                $('#uf').attr('disabled', 'disabled');
            });
        }
        else
        {
            $('#uf').removeAttr('disabled');
            $('#choose_uf').removeAttr('disabled');
        }
    });

    $('#cover-lamination').change(function() {
        var v = $(this).val();
        var a = v.split(' ');
        if (a[0] != 'no' && a[1] == 'glossy')
        {
            $('#cover-uf').load("default_uf.php", function() {
                $('#cover-uf').change();
                $('#cover-uf').attr('disabled', 'disabled');
            });
            $('#choose_cover-uf').attr('disabled', 'disabled');
        }
        else
        {
            $('#cover-uf').removeAttr('disabled');
            $('#choose_cover-uf').removeAttr('disabled');
        }
    });

    $('#uf').change(function() {
        var v = $(this).val();
        if (v != "no")
            v = "";
        $('#uf_checkbox').load("update_uf_checkbox.php?ch=" + v, function() {
            var x = chooseProduct.val();
            if (x == 'Booklet_(termo-glue)')
            {
                $('#choose_uf').attr('checked', 'checked');
                $('#choose_uf').attr('disabled', 'disabled');
            }
            else
            {
                $('#choose_uf').removeAttr('checked');
                $('#choose_uf').removeAttr('disabled');
            }
        });
    });


    $('#cover-uf').change(function() {
        var v = $(this).val();
        if (v != "no")
            v = "";
        $('#cover_uf_checkbox').load("update_cover_uf_checkbox.php?ch=" + v, function() {
            var x = chooseProduct.val();
            if (x == 'Booklet_(termo-glue)')
            {
                $('#choose_cover_uf').attr('checked', 'checked');
                $('#choose_cover_uf').attr('disabled', 'disabled');
            }
            else
            {
                $('#choose_cover_uf').removeAttr('checked');
                $('#choose_cover_uf').removeAttr('disabled');
            }
        });
    });

    var density = $('#density');
    
    density.change(function() {
        var v = $(this).val();
        if (v < "130" || v == "90") {
            $('#lamination').load("default_lamination.php");
            $('#lamination').attr('disabled', 'disabled');
        }
        else
        {
            $('#lamination').removeAttr('disabled');
        }
    });
    density.change();
});
