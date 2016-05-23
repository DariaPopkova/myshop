<?
//print_r($arResult);
?>
<div >
    <ol class="breadcrumbs">
        <?for($i=count($arResult[0]); $i>=1; $i--):?>
            <li><a href="http://popkova.bitrix.develop.maximaster.ru/catalog.php?SECTION_ID=<?=$arResult[0][$i]['ID']?>">
            <?echo $arResult[0][$i]['NAME'];
            echo '</li></a>';
       endfor;?>
    </ol>
</div>
