<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult['ITEMS']) > 0):?>
<div class="breadcrumbs">
    <ul>
        <?foreach ($arResult['ITEMS'] as $k => $item):?>
        <?if ($item['LAST'] === true):?>
        <li><span><?=$item['TITLE']?></span></li>
        <?else:?>
        <li><a href="<?=$item['LINK']?>"><?=$item['TITLE']?></a></li>
        <?endif;?>
        <?endforeach;?>
    </ul>
</div>
<?endif;?>