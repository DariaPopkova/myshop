</article>
<?$APPLICATION->IncludeComponent("my:brand", ".default", array());?>
</div>


</div>
<footer>
    <div id="kont">


    </div>
    <div id="ssilki">

    </div>
    <div id="niz">
        <div id="komp">

        </div>
        <div id="naverh">

        </div>


    </div>

</footer>

<script type="text/javascript" language="javascript">
    function del(bin) {
        var msg  = true;
        //alert(bin);
        $.ajax({
            type: 'POST',
            dataType: 'text',
            url: 'delete.php',
            data: {'id': bin},
            success: function(data) {
                alert(data);
            },
            error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });

    }

</script>
<script type="text/javascript" language="javascript">
    function viv(formsub) {
        var msg   = $("#"+formsub).serialize();

        $.ajax({
            type: 'POST',
            url: 'form.php',
            data: msg,
            success: function(data) {
                alert(data);
            },
            error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);

            }
        });

    }

</script>
<script>
    formsub.style.display = 'none';
    but.addEventListener("click", function () {
        //alert("sucsess"); // сработает по окончании анимации
        formsub.style.display = (formsub.style.display == 'none') ? '' : ''

    });
</script>
<script>
    function subbasket(){
        var submit = true;
        //alert(submit);
        $.ajax({
            type: 'POST',
            url: 'basket.php',
            data: submit,
            success: function(data) {
                alert(data);
            },
            error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
    }
</script>
<script>
    $(function() {
        $a = $('.cart_aj a');
        $('#select').change(function() {

            var value=$("select#select").val();

          //  $('#select option').removeAttr('selected');

           // $('#select option[value="'+value+'"]').attr('selected', 'selected');
        });
        $a.click(function(event) {

           event.preventDefault();
            var value=$("select#select").val();
            var path = "/local/templates/my/addbasket.php";

            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i=0;i<vars.length;i++) {
                var pair = vars[i].split("=");
                if(pair[0] == "ID"){
                    //alert(pair[1]);
                   var id = pair[1];
                }
            }

            $.ajax({
                url: path, // куда отправляем
                type: 'POST', // метод передачи
                dataType: 'json', // тип передачи данных
                data: { // что отправляем
                    kol: value,
                    ID: id

                },
                success: function (data) {
                    $("#basket_S").html(data);
                }
            });




            //document.getElementByID("kolich").innerHTML=5;

        });
    });
    /* function add_to_basket() {

     var value = $("select#select").val();
     $("#select option[value=4]").attr('selected', 'selected');
     alert(value);

     }*/


</script>
<!--<script>
    $(function() {
        $a = $('.cart_aj a');

        $a.click(function (event) {
            var kolich = $('#kolich').text();
            var kolich_elem = $('#temp_kolich').text();
            alert(kolich_elem);
            var price_elem = $('#price_for').text();
            document.getElementById('kolich').innerHTML++;
            //alert(document.getElementById('kolich').innerHTML);
            var price = $('#price').text();
            document.getElementById('price').innerHTML+=document.getElementById('temp_kolich').innerHTML*document.getElementById('temp_price').innerHTML;
            alert(price_elem);
        });
    });
</script>-->
</body>
</html>
