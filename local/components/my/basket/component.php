<?
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
define('HLIBLOCK_BRANDS', 3);
define('IBLOCK_PRODUCTS', 4);
array_map('CModule::IncludeModule', ['iblock','highloadblock','catalog','sale']);
$brandDataClass = HL\HighloadBlockTable::compileEntity(
    HL\HighloadBlockTable::getById(HLIBLOCK_BRANDS)
        ->fetch()
)->getDataClass();
$site=CSite::GetList(
    $by="sort",
    $order="desc",
    array(
        "NAME" => "Интернет-магазин (Сайт по умолчанию)"
    )
);
$site_id = $site->Fetch();
//print_r($site_id['ID']);
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
    $arResult[$arItems['ID']] = array(
        "NAME" => $arItems['NAME'],
        "PRICE" => $arItems['PRICE'],
        "QUANTITY" => $arItems['QUANTITY'],
        "ID" => $arItems['ID']
    );
    $searchElement = CIBlockElement::GetList(
        array(),
        array(
            'ID' => $arItems['PRODUCT_ID']
        ),
        false,
        false,
        [
            'ID', 'IBLOCK_ID','IBLOCK_SECTION_ID', 'NAME', 'DETAIL_PICTURE', 'SECTION_ID',
            'PROPERTY_ARTNUMBER',
            'PROPERTY_MANUFACTURER',
            'PROPERTY_DESCRIPTION',
            'PROPERTY_BRAND_REF',
            '*',
            'PROPERTY_*'
        ]
    );
    if($arElement = $searchElement->GetNext()) {
        $brand_result = $brandDataClass::getList(array(
            "select" => array(
                'ID',
                'UF_NAME',
                'UF_XML_ID'
            ),
            "order" => array(),
            "filter" => array(
                'UF_XML_ID' => $arElement["PROPERTY_BRAND_REF_VALUE"]
            )
        ));
        $brend = $brand_result->Fetch()['UF_NAME'];
        $quantity = CCatalogProduct::GetList(
            array(),
            array(
                'ID'=> $arElement['ID']
            )
        );
        $ar_quantity = $quantity->Fetch()['QUANTITY'];
        $arResult[$arItems['ID']]['DETAIL_PICTURE'] = CFile::GetPath($arElement["DETAIL_PICTURE"]);
        $arResult[$arItems['ID']]['ARTNUMBER'] = $arElement["PROPERTY_ARTNUMBER_VALUE"];
        $arResult[$arItems['ID']]['DESCRIPTION'] = $arElement["PROPERTY_DESCRIPTION_VALUE"];
        $arResult[$arItems['ID']]['MANUFACTURER'] = $arElement["PROPERTY_MANUFACTURER_VALUE"];
        $arResult[$arItems['ID']]['BRAND_REF'] =  $brend;
        $arResult[$arItems['ID']]['QUANTITY'] =  $ar_quantity;

    }
}

//echo $cntBasketItems;
//$arResult[];
$this->IncludeComponentTemplate(); // <- $arResult
?>