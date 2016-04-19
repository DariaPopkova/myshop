<?if (!empty($arResult)): // если есть хотя бы 1 пункт меню, можно начинать вывод?>
    <ul id="horizontal-multilevel-menu">

    <?
    $previousLevel = 0; // переменная содержит значение DEPTH_LEVEL предыдущего пункта
foreach($arResult as $arItem): // пробегаем по пунктам, $arItem - массив с информацией о текущем пункте?>

    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
        <?// если уровень вложенности текущего пункта меню меньше чем у предыдущего, значит "подменю" закончилось и нужно закрыть список?>
        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?endif?>

    <?if ($arItem["IS_PARENT"]): //если пункт содержит подменю, выводим ссылку и начинаем новый список (тег <ul>)?>

    <?if ($arItem["DEPTH_LEVEL"] == 1): // если уровень вложенности =1, т.е. это главное меню?>
    <?// выводим ссылку и добавляем класс "root-item" если пункт неактивный и "root-item-selected" если активный?>
    <li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
    <ul>
    <?else: // для остальных уровней вложенности?>
    <?// выводим ссылку и добавляем класс "parent". Если пункт активный, для элемента списка <li> добавляем класс "item-selected"?>
    <li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
    <ul>
    <?endif?>

    <?else: // для пунктов, не содержащих подменю?>

        <?if ($arItem["PERMISSION"] > "D"): // проверяем право доступа к пункту?>

            <?if ($arItem["DEPTH_LEVEL"] == 1): // если уровень вложенности =1, т.е. это главное меню?>
                <?// выводим ссылку и добавляем класс "root-item" если пункт неактивный и "root-item-selected" если активный?>
                <li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
            <?else: // для остальных уровней вложенности?>
                <?// выводим ссылку. Если пункт активный, для элемента списка <li> добавляем класс "item-selected"?>
                <li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>

        <?else: // для пунктов, к которым запрещен доступ?>

            <?if ($arItem["DEPTH_LEVEL"] == 1): // если уровень вложенности =1, т.е. это главное меню?>
                <?// выводим пустую ссылку и добавляем класс "root-item" если пункт неактивный и "root-item-selected" если активный?>
                <li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
            <?else: // для остальных уровней вложенности?>
                <?// выводим пустую ссылку и добавляем класс "denied"?>
                <li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>

        <?endif?>

    <?endif?>

    <?$previousLevel = $arItem["DEPTH_LEVEL"]; // запоминаем уровень вложенности?>

<?endforeach?>

    <?if ($previousLevel > 1):// если работа завершилась на пункте меню с уровнем вложенности >1, закрываем вложенные списки?>
        <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
    <?endif?>

    </ul>
    <div class="menu-clear-left"></div>
<?endif?>