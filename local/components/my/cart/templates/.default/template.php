<? foreach ($arResult as $category): ?>

    <h2><? echo $category['NAME']; ?></h2>
    <div id="cartfon">
        <div id="pokupka">
            <div id="price_cart">
                <div class="prop_naz_cart"><h3>Цена:</h3></div>
                <div class="prop_cart">
                    <? echo $category['PRICE']; ?>
                </div>
            </div>
        </div>
        <p style="text-align: center"><button>Купить</button>
        <div id="imgcart"><img src="<?= $category['DETAIL_PICTURE']; ?>"></div>
        <div id="opisanie">
            <div class="prop_tov"><? echo $category['CHARACTERISTICS']; ?></div>
        </div>
        <div id="char">
            <div id="naz_cart">
                <div class="prop_naz">Цвет:</div>
                <div class="prop_naz">Артикул:</div>
                <div class="prop_naz">Производитель:</div>
                <div class="prop_naz">Бренд:</div>
            </div>
            <div class="prop_tov"><? echo $category['DESCRIPTION']; ?></div>
            <div class="prop_tov"><? echo $category['ARTNUMBER']; ?></div>
            <div class="prop_tov"><? echo $category['MANUFACTURER']; ?></div>
            <div class="prop_tov"><? echo $category['BRAND']; ?></div>
        </div>


    </div>
<? endforeach; ?>
