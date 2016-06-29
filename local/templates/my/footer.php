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
   /* jQuery.fn.extend({
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
                        $input.color(input_znach,input_znach, max_temp, $plus,$minus);
                    }
                );
            }
            else
            {
                alert('Товара больше нет!');
            }

        });

    });*/
</script>
<script>
    $(document).ready(function() {
        var $local_div = $('div.bx-ui-combobox-fake.bx-combobox-fake-as-input');
        var local = $local_div.text();
        alert(local);
        var $input  = $('#ID_PROFILE_ID option:selected');
        var input_znach  = $input.text();
        alert(input_znach);
        $('#ID_PROFILE_ID').change(function() {
            var value = $("select#ID_PROFILE_ID").val();
            $('#ID_PROFILE_ID option').removeAttr('selected');
            $('#ID_PROFILE_ID option[value="'+value+'"]').attr('selected', 'selected');
            var text_val = $('#ID_PROFILE_ID option:selected').text();
            alert(text_val);
            if(text_val == "Новый профиль")
            {
                var $local_div = $('div.bx-ui-combobox-fake');
                var local = $local_div.text();
                alert(local);
                $local_div.change(function()
                    {
                        alert($local_div.text());
                    }
                );

            }
        });

        var $local_div = $('div.bx-ui-combobox-fake.bx-combobox-fake-as-input');
        var local = $local_div.text();
        alert(local);
        $('div.bx-ui-combobox-variant').change(function()
            {
                $local_div.text();
                alert("sucsess");
            }
        );
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



       //var select_zakaz = $('#ID_PROFILE_ID option:selected').val();
       // alert(input_znach);
        /*$.post(
            '/local/templates/my/addbasket.php',
            {
                kol:  input_znach
            },
            function (data)
            {
                $("#basket_S").html(data);
                basket = parseInt($('#basket_kol').html());
                $max_obyavlenie.html(max - basket);
                $input.val(1);
                max_temp = $max_obyavlenie.html();
                input_znach  = parseInt($input.val());
                $input.color(input_znach,input_znach, max_temp, $plus,$minus);
            }
        );
    }
    else
    {
        alert('Товара больше нет!');
    }*/


    });
</script>

</body>
</html>
