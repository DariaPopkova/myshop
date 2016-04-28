
<!--<pre>
    <?print_r($arResult);?>
</pre>-->
<?//if($_GET['find_section_section']=)?>

    <div class="section">
        <h2>Тренды сезона</h2>
        <? foreach($arResult as $category): ?>
            <a href="http://popkova.bitrix.develop.maximaster.ru/cart.php?IBLOCK_ID=<?=$category['IBLOCK_ID'];?>&find_section_section=<?=$category['IBLOCK_SECTION_ID']?>&ELEMENT_ID=<?=$category['ID'];?>">
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
            </a>
        <? endforeach; ?>
    </div>
<aside>
    <div id="poisk">
        <form >
            <input type="search" class="srch" placeholder="Поиск по сайту">
            <input type="submit" class="srch" value="Найти">

        </form>
    </div>


    <div id="info">
        <h6>ПОЛЕЗНАЯ ИНФОРМАЦИЯ</h6>
        <a target="_blank" class="info-box" href="/">
            <div id="img1"></div>

            <h6>О МАГАЗИНЕ</h6>
            <div class="info-content">
                Узнайте больше о нашем магазине,о наших контактах и реквизитах.
            </div>

        </a>

    </div>
</aside>
<?

?>

