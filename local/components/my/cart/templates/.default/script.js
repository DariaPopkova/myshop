$(document).ready(function() {
    $.fn.extend({
        color: function (input_znach, max, $plus,$minus) {
            if(input_znach == 0)
            {
                $minus.addClass("minus_plus_gray");
                $plus.addClass("minus_plus_gray");
            }
            else
            {
                if(input_znach == 1)
                {
                    $minus.addClass("minus_plus_gray");
                    $plus.removeClass("minus_plus_gray");
                }
                else
                {
                    if(input_znach == max)
                    {
                        $plus.addClass("minus_plus_gray");
                        $minus.removeClass("minus_plus_gray");

                    }
                    else
                    {
                        $minus.removeClass("minus_plus_gray");
                        $plus.removeClass("minus_plus_gray");
                    }
                }
            }

        }
    });
    var $input  = $('#number_kol');
    var input_znach  = parseInt($input.val());
    var $max_obyavlenie = $('#residue_znach');
    var max = parseInt($max_obyavlenie.html());
    var basket = parseInt($('#basket_kol').html());
    if($.isNumeric(basket) == false)
    {
        basket = 0;
    }
    var max_temp = max  - basket;
    if(max_temp == 0)
    {
        $input.val(0);
        input_znach  = parseInt($input.val());
    }
    var $minus = $('span.minus');
    var $plus = $('span.plus');
    $input.color(input_znach, max_temp, $plus,$minus);
    $input.change(function () {
        input_znach =  parseInt($input.val());
        if($.isNumeric(input_znach) == true)
        {
            if(input_znach > max_temp)
            {
                alert('Превышенно значение ввода!');
                $input.val(max_temp);
            }
            if(input_znach <= 0)
            {
                alert('Неправильное значение ввода!');
                $input.val(1);
            }
        }
        else
        {
            alert('Вы ввели символы.');
            $input.val(1);
        }
        if(max_temp == 0)
            $input.val(0);
        input_znach =  parseInt($input.val());
        $input.color(input_znach, max_temp, $plus,$minus);

    });
    $minus.click(function () {
        var count = input_znach - 1;
        if(input_znach > 1)
        {
            $input.val(count);
            input_znach = count;
            $input.color(input_znach, max_temp, $plus,$minus);
        }
        else
        {
            alert('Не стоит этого делать.');
        }
        return false;
    });
    $plus.click(function () {
        var count = input_znach + 1;
        if(input_znach < max_temp)
        {
            $input.val(count);
            input_znach = count;
            $input.color(input_znach, max_temp, $plus,$minus);
        }
        else
        {
            $input.val(max_temp);
        }
        return false;
    });
    $a = $('.cart_aj a');
    $max_obyavlenie.html(max_temp);
    $a.click(function(event)
    {
        event.preventDefault();
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++)
        {
            var pair = vars[i].split("=");
            if(pair[0] == "ID"){
                var id = pair[1];
            }
        }
        if(max_temp  > 0)
        {
            $.post(
                '/local/templates/my/addbasket.php',
                {
                    kol:  input_znach,
                    ID: id
                },
                function (data)
                {
                    $("#basket_S").html(data);
                    basket = parseInt($('#basket_kol').html());
                    $max_obyavlenie.html(max - basket);
                    max_temp = $max_obyavlenie.html();

                    if(max_temp > 0)
                        $input.val(1);
                    else
                        $input.val(0);
                    input_znach  = parseInt($input.val());
                    $input.color(input_znach, max_temp, $plus,$minus);
                }
            );
        }
        else
        {
            alert('Товара больше нет!');
        }

    });

});




