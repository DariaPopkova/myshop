<nav>

    <?//print_r($arResult);?>
    <ul id="v-menu">
    <?foreach($arResult as $section): ?>
        <li class="menu">
            <span id="s1"></span>
<?//print_r($section['ID']);?>
            <a href="http://popkova.bitrix.develop.maximaster.ru/catalog.php?IBLOCK_ID=<?=$section['IBLOCK_ID'];?>&find_section_section=<?=$section['ID']?>" class="menus"><?echo $section['NAME'];?></a>
            <ul class="ot">
        <?foreach($section['CHILDRENS'] as $val): ?>
                 <?//echo $val['IBLOCK_ID'];?>
                <li><a href="http://popkova.bitrix.develop.maximaster.ru/catalog.php?IBLOCK_ID=<?=$section['IBLOCK_ID'];?>&find_section_section=<?=$val['ID'];?>"><?=$val['NAME'];?></a></li>
        <?endforeach;?>

            </ul>
        </li>
    <?endforeach; ?>
    </ul>
</nav>