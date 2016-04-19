<?
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
define('HLIBLOCK_BRANDS', 3);
define('IBLOCK_PRODUCTS', 4);
array_map('CModule::IncludeModule', ['iblock', 'highloadblock']);

$brandDataClass = HL\HighloadBlockTable::compileEntity(
    HL\HighloadBlockTable::getById(HLIBLOCK_BRANDS)
        ->fetch()
)->getDataClass();
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
echo '<pre>';
//print_r($arParams);
echo '</pre>';
CModule::IncludeModule('iblock');


//$arElement["DETAIL_PICTURE"] = array();
if (!empty($_GET["find_section_section"]))
{ echo " Получены новые вводные: имя - ".$_GET["find_section_section"]."";}
else { echo "Переменные не дошли. Проверьте все еще раз."; }
$section_id = $_GET["find_section_section"];

// ID - число, число > 0, [товар существует?]
if(is_numeric($section_id) && intval($section_id) > 0)
{
    echo "Всё хорошо!";
}
else{
    LocalRedirect("/404.php", "404 Not Found");
}



$rsElement = CIBlockElement::GetList(
    array(),
    array(

        'IBLOCK_ID' => IBLOCK_PRODUCTS,
        'IBLOCK_SECTION_ID' => $section_id,
    ),
    false,
    false,
    [
        'ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PICTURE',
        'PROPERTY_ARTNUMBER',
        'PROPERTY_MANUFACTURER',
        'PROPERTY_DESCRIPTION',
        'PROPERTY_BRAND_REF',
        'PROPERTY_*'
    ]
);

if($arElement = $rsElement->GetNext())
{
    echo '<pre>';
    //print_r($arElement);
    echo '</pre>';

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
    $array_brend = $brand_result->Fetch()['UF_NAME'];
    //print_r(CFile::GetFileArray($arElement["DETAIL_PICTURE"]));
    //print_r(CFile::GetPath($arElement["DETAIL_PICTURE"]));
    // $rCIBlockElement::GetList(array(),array("DESCRIPTION"=>$arElement["DESCRIPTION"]));
    //$arviv = $r->GetNext();
    //print_r($arviv);
    //print_r($arElement["PROPERTY_BRAND_REF_VALUE"]);

    /*
        $propertiesCIBlockElement::GetList(
            Array(),
            Array(
            "NAME" =>$arElement["NAME"]
        )
            );
        $prop_fields = $properties->GetNext();
        print_r($prop_fields);*/


}
else{
    LocalRedirect("/404.php", "404 Not Found");
}

$arResult['NAME'] = $arElement["NAME"];
$arResult['DESCRIPTION']=$arElement["PROPERTY_DESCRIPTION_VALUE"];
$arResult['ARTNUMBER']=$arElement["PROPERTY_ARTNUMBER_VALUE"];
$arResult['MANUFACTURER']=$arElement["PROPERTY_MANUFACTURER_VALUE"];
$arResult['DETAIL_PICTURE'] = CFile::GetPath($arElement["DETAIL_PICTURE"]);
$arResult['BRAND'] = $array_brend;



//$arResult = array_merge($arResult,$arElement);




$this->IncludeComponentTemplate(); // <- $arResult

?>