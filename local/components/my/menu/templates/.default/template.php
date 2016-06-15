<nav>
    <ul id="v-menu">
    <?foreach($arResult as $section): ?>
        <li class="menu">
            <span id="s1"></span>
<?//print_r($section['ID']);?>
            <a href="http://popkova.bitrix.develop.maximaster.ru/catalog.php?SECTION_ID=<?=$section['ID']?>" class="menus"><?echo $section['NAME'];?></a>
            <ul class="ot">
        <?foreach($section['CHILDRENS'] as $val): ?>
                 <?//echo $val['IBLOCK_ID'];?>
                <li><a href="http://popkova.bitrix.develop.maximaster.ru/catalog.php?SECTION_ID=<?=$val['ID'];?>"><?=$val['NAME'];?></a></li>
        <?endforeach;?>
            </ul>
        </li>
    <?endforeach; ?>
    </ul>
</nav>
