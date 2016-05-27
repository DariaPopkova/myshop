<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
echo '<pre>';
print_r($arResult);
echo '</pre>';
print_r($_SERVER['REQUEST_URI']);
//parse_url();
//var_dump();
if($_SERVER['REQUEST_URI'] == '/personal/cart/')
{
    $count = count($arResult["ITEMS"]);
    $sum = 0;
    foreach($arResult["ITEMS"] as $v)
    {
        $sum = $sum + $v["PRICE"];
    }
    foreach ($arBasketItems as &$arItem)
    {
        if (CSaleBasketHelper::isSetItem($arItem))
            continue;

        $boolOneReady = false;


        if (!$boolOneReady)
        {
            $arItem["PRICE_FORMATED"] = SaleFormatCurrency($arItem["PRICE"], $arItem["CURRENCY"]);
            $arItems[] = $arItem;
        }

    }?>
    <div id="basket_S">
        <div id="char_s">
            <div id="naz_cart_b">
                <div class="prop_naz">Сумма:</div>
                <div class="prop_naz">Количество:</div>
            </div>

            <div id="naz_pro_b">
                <div class="prop_tov_b"><?echo $sum; ?></div>
                <div class="prop_tov_b"><?echo  $count;?></div>
            </div>
        </div>
        <div class="basket_url"><a href="/personal/cart">Перейти в корзину</a></div>
    </div>
    </div>
<?
}
?>



