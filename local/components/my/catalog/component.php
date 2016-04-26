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

/*if (!empty($_GET["find_section_section"])) //SECTION_ID
{ echo " Получены новые вводные: имя - ".$_GET["find_section_section"]."";}
else { echo "Переменные не дошли. Проверьте все еще раз."; }*/
if (empty($_GET["find_section_section"])) //SECTION_ID
{
    LocalRedirect("/404.php", "404 Not Found");
}
$section_id = $_GET["find_section_section"];
// ID - число, число > 0, [товар существует?]
if(!is_numeric($section_id) && intval($section_id) < 0)
{
    LocalRedirect("/404.php", "404 Not Found");
}
$search_section = CIBlockSection::GetList(
    array(),
    array(
        'ID' => $section_id
    )
);
$arsec = $search_section->GetNext();
if(empty($arsec))
{
    LocalRedirect("/404.php", "404 Not Found");
}

$rsElement = CIBlockElement::GetList(
    array(),
    array(

        'IBLOCK_ID' => IBLOCK_PRODUCTS,
        'SECTION_ID' => $section_id,
    ),
    false,
    false,
    [
        'ID', 'IBLOCK_ID','IBLOCK_SECTION_ID', 'NAME', 'DETAIL_PICTURE',
        'PROPERTY_ARTNUMBER',
        'PROPERTY_MANUFACTURER',
        'PROPERTY_DESCRIPTION',
        'PROPERTY_BRAND_REF',
        'PROPERTY_*'
    ]
);

while($arElement = $rsElement->GetNext())
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
    $arProduct['NAME'] = $arElement["NAME"];
    $arProduct['DESCRIPTION']=$arElement["PROPERTY_DESCRIPTION_VALUE"];
    $arProduct['ARTNUMBER']=$arElement["PROPERTY_ARTNUMBER_VALUE"];
    $arProduct['MANUFACTURER']=$arElement["PROPERTY_MANUFACTURER_VALUE"];
    $arProduct['DETAIL_PICTURE'] = CFile::GetPath($arElement["DETAIL_PICTURE"]);
    $arProduct['BRAND'] = $array_brend;
    $arProduct['IBLOCK_ID']= $arElement['IBLOCK_ID'];
    $arProduct['IBLOCK_SECTION_ID']= $arElement['IBLOCK_SECTION_ID'];
    $arProduct['ID']= $arElement['ID'];


    $arResult[] = $arProduct;
}

   // LocalRedirect("/404.php", "404 Not Found");
//$arResult = array_merge($arResult,$arElement);
$this->IncludeComponentTemplate(); // <- $arResult

?>