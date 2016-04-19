<h2>Тренды сезона</h2>
<pre>
    <?print_r($arResult);?>
</pre>

<div class="tov">

            <div> <img src="<?=$arResult['DETAIL_PICTURE'];?>" width="200" height="200" ></div>
            <div><?echo $arResult['NAME'];?></div>
            <div><?echo $arResult['DESCRIPTION'];?></div>
            <div><?echo $arResult['ARTNUMBER'];?></div>
            <div><?echo $arResult['MANUFACTURER'];?></div>
            <div><?echo $arResult['BRAND'];?></div>

</div>
