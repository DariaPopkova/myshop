<pre>
    <?//print_r($arResult);?>
</pre>

    <?if($_GET['find_section_section'] != $arResult[0]['IBLOCK_SECTION_ID']):?>
        <div id="glav_pun"><?echo $arResult['NAME'];?></div>
        <? foreach($arResult['SUBSECTION'] as $section): ?>
            <div class="podpun">
                <a href="http://popkova.bitrix.develop.maximaster.ru/catalog.php?IBLOCK_ID=<?=$section['IBLOCK_ID'];?>&find_section_section=<?=$section['ID']?>">
                <?echo $section['NAME'];?>
                </a>
            </div>
        <? endforeach;
        ?>
    <?else:?>
        <?if(!empty($arResult[0]['PODSECTION'])):?>
            <div id="glav_pun"><?echo $arResult[0]['NAMESECTION'];?></div>
            <? foreach($arResult[0]['PODSECTION'][$arResult[0]['IBLOCK_SECTION_ID']] as $section):
                //print_r($section);?>
                <div class="podpun">
                    <a href="http://popkova.bitrix.develop.maximaster.ru/catalog.php?IBLOCK_ID=<?=$section['IBLOCK_ID'];?>&find_section_section=<?=$section['ID']?>">
                        <?echo $section['NAME'];?>
                    </a>
                </div>
            <? endforeach;?>
        <?endif;//if()?>
        <?if(!empty($arResult[0]['NAME'])):?>
                <h2>Тренды сезона</h2>
            <div class="section">
            <? foreach($arResult as $category):
                ?>
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
            <? endforeach;
            ?>
            </div>
        <?endif;?>
    <?endif;?>

