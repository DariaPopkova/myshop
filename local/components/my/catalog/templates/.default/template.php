<pre>
    <? //print_r($arResult); ?>
</pre>
<div id="glav_pun"><? echo $arResult['NAMESECTION']['NAME']; ?></div>
<? foreach ($arResult['SECTIONS'] as $section): ?>
    <div class="podpun">
        <a href="/catalog.php?IBLOCK_ID=<?= $section['IBLOCK_ID']; ?>&find_section_section=<?= $section['ID'] ?>">
            <? echo $section['NAME']; ?>
        </a>
    </div>
<? endforeach;?>
<? if (!empty($arResult['PRODUCTS'])): ?>
    <h2>Тренды сезона</h2>
    <div class="section">
        <? foreach ($arResult['PRODUCTS'] as $category):
            ?>
            <a href="/cart.php?IBLOCK_ID=<?= $category['IBLOCK_ID']; ?>&find_section_section=<?= $category['IBLOCK_SECTION_ID'] ?>&ELEMENT_ID=<?= $category['ID']; ?>">
                <div class="tov">
                    <div class="imgtov"><img src="<?= $category['DETAIL_PICTURE']; ?>"></div>
                    <div class="prop_tov_name"><? echo $category['NAME']; ?></div>
                    <div class="naz">
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
            </a>
        <? endforeach; ?>
    </div>
<? endif; ?>

