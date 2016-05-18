<?
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

define('IBLOCK_PRODUCTS', 4);
array_map('CModule::IncludeModule', ['iblock','catalog','sale']);
$site=CSite::GetList(
    $by="sort",
    $order="desc",
    array(
        "NAME" => "www.mysite.ru"
    )
);
$site_id = $site->Fetch();
print_r($site_id['ID']);
$dbBasketItems = CSaleBasket::GetList(
    array(

    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => $site_id['ID'],
        "ORDER_ID" => "NULL"
    ),
    false,
    false,
    array()
);
while ($arItems = $dbBasketItems->Fetch())
{
    print_r($arItems);
    $arResult = array(
        "NAME" => "",
        "PRICE" => $arItems['PRICE'],
        "QUANTITY" => $arItems['QUANTITY'],
        "ID" => $arItems['ID']
    );

}

//echo $cntBasketItems;
//$arResult[];
$this->IncludeComponentTemplate(); // <- $arResult
?>