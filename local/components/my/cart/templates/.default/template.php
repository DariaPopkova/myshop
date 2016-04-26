

    <? foreach($arResult as $category): ?>
        <?print_r($category['CHARACTERISTICS']);?>
        <h2><?echo $category['NAME'];?></h2>
            <div id="cartfon">

                <div id="imgcart"> <img src="<?=$category['DETAIL_PICTURE'];?>"  ></div>
                <div id="char">
                    <div id="naz_cart">
                        <div class="prop_naz">Цвет:</div>
                        <div class="prop_naz">Артикул:</div>
                        <div class="prop_naz">Производитель:</div>
                        <div class="prop_naz">Бренд:</div>
                    </div>
                    <div class="prop_tov"><?echo $category['DESCRIPTION'];?></div>
                    <div class="prop_tov"><?echo $category['ARTNUMBER'];?></div>
                    <div class="prop_tov"><?echo $category['MANUFACTURER'];?></div>
                    <div class="prop_tov"><?echo $category['BRAND'];?></div>
                </div>
                <div id="opisanie">
                    <div class="prop_tov"><?echo $category['CHARACTERISTICS'];?></div>
                </div>

            </div>
    <? endforeach; ?>
