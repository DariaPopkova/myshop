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
                $('.results').html(data);
            },
            error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });

    }

</script>
</body>
</html>
