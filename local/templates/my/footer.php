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
    $(document).ready(function() {
        var input = document.getElementById("number_kol");
        var max = parseInt(document.getElementById("residue_znach").innerHTML);
        var kol_prev = max - Number(document.getElementById("basket_kol").innerHTML);
        input.oninput = function()
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

        };
        $('.minus').click(function () {
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
        });
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
        });
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
    });
</script>

</body>
</html>
