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
    $(function() {
        $a = $('.cart_aj a');
        $a.click(function(event) {
            event.preventDefault();
            var value=$("input#select").val();

            var max = parseInt($('#select').attr('max'));
            if (value > max) {
                alert( 'Это значение больше максимального, т.е больше '+max+'. Введите заново верное значение.' );
                document.getElementById("select").value = max;
            }
            else
            {
                var query = window.location.search.substring(1);
                var vars = query.split("&");
                for (var i=0;i<vars.length;i++) {
                    var pair = vars[i].split("=");
                    if(pair[0] == "ID"){
                        var id = pair[1];
                    }
                }
                var add = Number($("#basket_kol").text())+Number(value);
                alert(add);
                if(add < max)
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

                        }
                    );
                }
                else{
                    alert('Добавляемое значение больше максимально допустимого, т.е больше '+max+'');
                }

            }

        });
    });

</script>
<script>

    $(document).ready(function() {

        var input = document.getElementById("number_kol");
       var input_prev_val = input.value;
       // alert(input_prev_val);

        input.oninput = function() {
            alert(input.value);
            //alert(input_prev_val);
           // alert(parseInt(document.getElementById("residue_znach").innerHTML));
            if(parseInt(input.value) <= parseInt(document.getElementById("residue_znach").innerHTML))
            {
                var id_number = parseInt(document.getElementById("residue_znach").innerHTML);
                id_number -= parseInt(input.value);
                document.getElementById("residue_znach").innerHTML = id_number;
                input_prev_val = input.value;
            }
            else{
                alert('Превышено значение ввода!');
            }

        };
        $('.minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            //if(count<=)


            $input.val(count);
            $input.change();
            var id_number = parseInt(document.getElementById("residue_znach").innerHTML);
            id_number += count;
            document.getElementById("residue_znach").innerHTML = id_number;
            alert(id_number);
            /*$.post(
                'local/components/my/cart/templates/.default/template.php',
                {
                    residue: count
                }
            );*/
            return false;
        });
        $('.plus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) + 1;
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            var id_number = parseInt(document.getElementById("residue_znach").innerHTML);
            id_number -= count;
            document.getElementById("residue_znach").innerHTML = id_number;
            return false;
        });

    });
</script>

</body>
</html>
