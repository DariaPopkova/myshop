</article>
<?$APPLICATION->IncludeComponent("my:brand", ".default", array());?>
</div>
</div>
<footer>
    <div id="kont"></div>
    <div id="ssilki"></div>
    <div id="niz">
        <div id="komp"></div>
        <div id="naverh"></div>
    </div>
</footer>
<script>
    formsub.style.display = 'none';
    but.addEventListener("click", function () {
        //alert("sucsess"); // сработает по окончании анимации
        formsub.style.display = (formsub.style.display == 'none') ? '' : ''
    });
</script>
<script>
    jQuery.fn.extend({
        color: function (count,input_znach, max, $plus,$minus) {

            if((count == 1)&&(input_znach == 1))
            {
                $minus.css({'background-color' : '#f2f2f2'});
                $plus.css({'background-color' : ' mediumseagreen'});

            }
            else
            {
                if((input_znach == 1)&&(count < 1))
                {
                    $minus.css({'background-color' : '#f2f2f2'});
                    $plus.css({'background-color' : ' mediumseagreen'});
                }
                else
                {
                    if(count == max)
                    {
                        $plus.css({'background-color' : '#f2f2f2'});
                        $minus.css({'background-color' : 'crimson'});
                    }
                    else
                    {

                        if((input_znach == max)&&(count > max))
                        {
                            $plus.css({'background-color' : '#f2f2f2'});
                            $minus.css({'background-color' : 'crimson'});
                        }
                        else
                        {
                            //if((input_znach == max)&&(count > max))
                            $minus.css({'background-color' : 'crimson'});
                            $plus.css({'background-color' : ' mediumseagreen'});
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
        var $minus = $('.minus');
        var $plus = $('.plus');
        $('.prop_naz_sk').select(function() {
            return false;
        });

        $input.color(1,input_znach, max_temp, $plus,$minus);
        $input.change(function () {
            input_znach =  parseInt($input.val());
            $input.color(1,input_znach, max_temp, $plus,$minus);
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
            $input.color(count,input_znach, max_temp, $plus,$minus);
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
                    }
                );
            }
            else
            {
                alert('Товара больше нет!');
            }

        });
        /*input.oninput = function();
        {
            if(parseInt(input.value) <= kol_prev)
            {
                var $input = $(this).parent().find('input');
                $input.val(count);
                $input.change();
                var id_number = kol_prev - parseInt(input.value);
            }
            else
            {
                alert('Превышено значение ввода!');
                input.value = kol_prev;
            }

        };*/
        /*$('.minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            if(parseInt($input.val()) > 1)
            {
                $input.val(count);
                $input.change();
                var id_number = kol_prev - count;
            }
            else
            {
                alert('Не стоит этого делать.');
            }
            return false;
        });*/
        /*
        $('.plus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) + 1;
            if(parseInt($input.val()) < kol_prev)
            {
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                var id_number = kol_prev - count;
            }
            else
            {
                document.getElementById("number_kol").innerHTML = kol_prev;
            }
            return false;
        });*/
        /*
         $a = $('.cart_aj a');
         document.getElementById("residue_znach").innerHTML = kol_prev;
         $a.click(function(event)
         {
         event.preventDefault();
         var value = Number(input.value);
         var query = window.location.search.substring(1);
         var vars = query.split("&");
         for (var i=0;i<vars.length;i++)
         {
         var pair = vars[i].split("=");
         if(pair[0] == "ID"){
         var id = pair[1];
         }
         }
         if(kol_prev  > 0)
         {
         $.post(
         '/local/templates/my/addbasket.php',
         {
         kol: value,
         ID: id
         },
         function (data)
         {
         $("#basket_S").html(data);
         document.getElementById("residue_znach").innerHTML = max - Number(document.getElementById("basket_kol").innerHTML);
         input.value = 1;
         kol_prev = document.getElementById("residue_znach").innerHTML;

         }
         );
         }
         else
         {
         alert('Товара больше нет!');
         }

         });
        */

    });
</script>

</body>
</html>
