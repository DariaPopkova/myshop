<div id="basket_S">
    <div id="char_s">
        <div id="naz_cart_b">
            <div class="prop_naz_b">Сумма:</div>
            <div class="prop_naz_b">Количество:</div>
        </div>

        <div id="naz_pro_b">
            <div id="price"><?echo $arResult['SUMM']['ORDER_PRICE']; ?></div>
                <div id="kolich"><?echo  $arResult['SUMM']['ORDER_WEIGHT'];?></div>

        </div>
    </div>
    <div id="basket_url"><a href="<?=$arParams['PATH_TO_BASKET'];?>">Перейти в корзину</a></div>
</div>

<!--<script>
    $(function() {
        $a = $('.cart_aj a');

        $a.click(function (event) {
            var kolich = $('#kolich').text();
            //document.getElementById('kolich').innerHTML++;
            alert(document.getElementById('kolich').innerHTML);
            var price = $('#price').text();
            //document.getElementById('price').innerHTML++;
            alert(price);
        });
    });
</script>-->



