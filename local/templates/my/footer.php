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
                var bask_kol = $(".basket_kol").html();
                alert(bask_kol);
            }

        });
    });

</script>
</body>
</html>
