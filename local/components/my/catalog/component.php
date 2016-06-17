<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
array_map('CModule::IncludeModule', ['iblock','catalog', 'sale', 'highloadblock']);
/* Входные данные и валидация */
$sectionID = intval($_GET["SECTION_ID"]);
$brandID = intval($_GET["brand_id"]);
$brandXML_ID = false;
$brandDataClass = HL\HighloadBlockTable::compileEntity(
    HL\HighloadBlockTable::getById(HLIBLOCK_BRANDS)
        ->fetch()
)->getDataClass();
if($brandID > 0)
{
    $brand = $brandDataClass::getList(array(
        "select" => array(
            'ID',
            'UF_NAME',
            'UF_XML_ID'
        ),
        "order" => array(),
        "filter" => array(
            'ID' => $brandID
        )
    ))->Fetch();
    if ( ! empty($brand))
    {
        $brandXML_ID = $brand['UF_XML_ID'];
    }
    else
    {
        LocalRedirect("/404.php", "404 Not Found");
    }
}
$arFilter = array(
    'IBLOCK_ID' => IBLOCK_PRODUCTS

);
$ar_sections = [];
$ar_parent = [];
$items = GetIBlockSectionList(
    IBLOCK_PRODUCTS,
    false,
    array()
);
while($arItem = $items->GetNext())
{
    $ar_sections[$arItem['ID']] = $arItem;
    if($arItem['IBLOCK_SECTION_ID'] == '')
    {
        $ar_parent[] = intval($arItem['ID']);
    }
}
if($sectionID >= 0)
{
    if($sectionID !== 0)
    {
        if(array_key_exists($sectionID,$ar_sections) == false)
        {
            LocalRedirect("/catalog.php");
        }
        $arResult['SECTIONS'][] = array_merge(
            array(
                'MAIN' => 'Y'
            ),
            $ar_sections[$sectionID]
        );
    }
    foreach($ar_sections as $section)
    {
        if($section['IBLOCK_SECTION_ID'] == $sectionID)
        {
            $arResult['SECTIONS'][] = $section;
        }
    }
}
/* Товары */
$key = array_search($sectionID,$ar_parent);
if((($sectionID !== 0)&&($key === false))||($brandID !== 0))
{
    if (!empty($brandXML_ID))
    {
        $arFilter['PROPERTY_BRAND_REF'] = $brandXML_ID;
        $arFilter['INCLUDE_SUBSECTIONS'] = "Y";
    }
    if($sectionID !== 0)
    {
        $arFilter['SECTION_ID'] = $sectionID;
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
        $arFields['DETAIL_PICTURE'] = CFile::GetPath($arFields["DETAIL_PICTURE"]);
        $arFields['PROPERTIES'] = $arProps;

        $arResult['PRODUCTS'][] = $arFields;

    }
}

$take_path = CIBlockSection::GetNavChain(IBLOCK_PRODUCTS, $sectionID);
while($ar_path=$take_path->GetNext())
{
    $APPLICATION->AddChainItem($ar_path['NAME'],$ar_path['SECTION_PAGE_URL']);
}

$this->IncludeComponentTemplate();