
<!--<pre>
    <?//print_r($arResult);?>
</pre>-->
<div class="section">
    <h2>Тренды сезона</h2>
    <? foreach($arResult as $category): ?>
        <div class="tov">

            <div class="imgtov"> <img src="<?=$category['DETAIL_PICTURE'];?>"  ></div>
            <div class="prop_tov_name"><?echo $category['NAME'];?></div>
            <div class="naz">
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
    <? endforeach; ?>
</div>