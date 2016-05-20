<?
echo '<pre>';
//print_r($arResult);
echo '</pre>';
?>
<?foreach($arResult as $zapis):?>
<div class="basket_block">
    <div class="imgbasket"><img src="<?= $zapis['DETAIL_PICTURE']; ?>"></div>
    <div class="basket_tov_name"><?echo $zapis['NAME']; ?></div>
    <div class="property_basket">
        <div class="naz">
            <div class="prop_naz">Цвет:</div>
            <div class="prop_naz">Артикул:</div>
            <div class="prop_naz">Производитель:</div>
            <div class="prop_naz">Бренд:</div>
        </div>
        <div class="prop_tov"><? echo $zapis['DESCRIPTION']; ?></div>
        <div class="prop_tov"><? echo $zapis['ARTNUMBER']; ?></div>
        <div class="prop_tov"><? echo $zapis['MANUFACTURER']; ?></div>
        <div class="prop_tov"><? echo $zapis['BRAND_REF']; ?></div>
    </div>
    <div class="property_basket_zen">
        <div class="naz">
            <div class="prop_naz">Цена:</div>
        </div>
        <div class="prop_tov"><? echo $zapis['PRICE']; ?></div>
    </div>
    <div class="property_basket_kol">
        <div class="naz">
            <div class="prop_naz">Количество:</div>
        </div>
        <form>
            <select name="hero">
                <?for($i = 1; $i<=$zapis['QUANTITY']; $i++):?>
                    <option value="<?= $i;?>"><?= $i;?></option>
                <?endfor;?>

            </select>
        </form>
    </div>
    <div class="property_basket_del">
        <input type="button" name="delite_zapis" id="<?= $zapis['ID']?>" value="Удалить" onclick="del($(this).attr('id'))">
    </div>
</div>
<?endforeach;?>

