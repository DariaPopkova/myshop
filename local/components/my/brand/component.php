<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

array_map('CModule::IncludeModule', ['iblock','catalog', 'sale', 'highloadblock']);
/* Входные данные и валидация */
$sectionID = intval($_GET["SECTION_ID"]);

$brandDataClass = HL\HighloadBlockTable::compileEntity(
    HL\HighloadBlockTable::getById(HLIBLOCK_BRANDS)
        ->fetch()
)->getDataClass();
$brand_result = $brandDataClass::getList(array(
    "select" => array(
        'ID',
        'UF_NAME',
        'UF_XML_ID'
    ),
    "order" => array(),
    "filter" => array()
));
$massiv_brend = [];
$name_brend = [];
while($array_brend = $brand_result->Fetch())
{
    $name_brend[$array_brend['UF_XML_ID']] = $array_brend;
    $massiv_brend[$array_brend['UF_XML_ID']] = $array_brend['UF_NAME'];
}
$arFilter = [
    'IBLOCK_ID' => IBLOCK_PRODUCTS,
];
if($sectionID > 0)
{
    $arFilter['SECTION_ID'] = $sectionID;
    $arFilter['INCLUDE_SUBSECTIONS'] = "Y";
}
$searchElement = CIBlockElement::GetList(
    array(),
    $arFilter,
    false,
    false,
    [
        'ID', 'IBLOCK_ID','IBLOCK_SECTION_ID', 'NAME', 'DETAIL_PICTURE', 'SECTION_ID', 'CATALOG_GROUP_1'
    ]
);
while($product = $searchElement->GetNextElement())
{
    $arFields = $product->GetFields();
    $arProps = $product->GetProperties();

    foreach($arProps as $pid => $prop)
    {
        $arProps[$pid] = CIBlockFormatProperties::GetDisplayValue($arFields, $prop);
    }
    $arFields['PROPERTIES'] = $arProps;

    $key_search = array_search($arFields['PROPERTIES']['BRAND_REF']['DISPLAY_VALUE'],$massiv_brend);
    if($key_search !== false)
    {
        $arResult[$key_search] = $name_brend[$key_search];

    }

}
$this->IncludeComponentTemplate(); // <- $arResult

?>