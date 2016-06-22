BX.ready(function() {
    jQuery.fn.extend({
        color: function (count,input_znach, max, $plus,$minus) {
            if((count == 1)&&(input_znach == 1))
            {
                $minus.css({'background-color' : '#f2f2f2', 'color' : 'black'});
                $plus.css({'background-color' : ' mediumseagreen', 'color' : 'white'});

            }
            else
            {
                if((input_znach == 1)&&(count < 1))
                {
                    $minus.css({'background-color' : '#f2f2f2', 'color' : 'black'});
                    $plus.css({'background-color' : ' mediumseagreen', 'color' : 'white'});
                }
                else
                {
                    if(count == max)
                    {
                        $plus.css({'background-color' : '#f2f2f2', 'color' : 'black'});
                        $minus.css({'background-color' : 'crimson', 'color' : 'white'});
                    }
                    else
                    {

                        if((input_znach == max)&&(count > max))
                        {
                            $plus.css({'background-color' : '#f2f2f2', 'color' : 'black'});
                            $minus.css({'background-color' : 'crimson', 'color' : 'white'});
                        }
                        else
                        {
                            $minus.css({'background-color' : 'crimson', 'color' : 'white'});
                            $plus.css({'background-color' : ' mediumseagreen', 'color' : 'white'});
                        }

                    }

                }
            }

        }
    });
    $(document).ready(function() {
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
        var $minus = $('span.minus');
        var $plus = $('span.plus');
        $('.prop_naz_sk').select(function() {
            return false;
        });
        $input.color(input_znach,input_znach, max_temp, $plus,$minus);
        $input.change(function () {
            input_znach =  parseInt($input.val());
            $input.color(input_znach,input_znach, max_temp, $plus,$minus);
            if(input_znach > max_temp)
            {
                alert('Превышенно значение ввода!');
                $input.val(max_temp);
                input_znach =  parseInt($input.val());
                $input.color(max_temp,input_znach, max_temp, $plus,$minus);
            }
            if(input_znach <= 0)
            {
                alert('Неправильное значение ввода!');
                $input.val(1);
                input_znach =  parseInt($input.val());
                $input.color(1,input_znach, max_temp, $plus,$minus);
            }

        });
        $minus.click(function () {
            var count = input_znach - 1;
            $input.color(count,input_znach, max_temp, $plus,$minus);
            if(input_znach > 1)
            {
                $input.val(count);
                input_znach = count;
            }
            else
            {
                alert('Не стоит этого делать.');
            }
            return false;
        });
        $plus.click(function () {
            var count = input_znach + 1;
            var input_znach  = parseInt($input.val());
            $input.color(input_znach,input_znach, max_temp, $plus,$minus);

            if(input_znach < max_temp)
            {
                $input.val(count);
                input_znach = count;
            }
            else
            {
                $input.val(max_temp);
            }
            return false;
        });
        $a = $('.cart_aj a');
        $max_obyavlenie.html(max_temp);
        //document.getElementById("residue_znach").innerHTML = kol_prev;
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
                        $input.val(1);
                        max_temp = $max_obyavlenie.html();
                        input_znach  = parseInt($input.val());
                        $input.color(1,input_znach, max_temp, $plus,$minus);
                    }
                );
            }
            else
            {
                alert('Товара больше нет!');
            }

        });

    });

});


