<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

array_map('CModule::IncludeModule', ['iblock','catalog', 'sale']);
$sectionID = intval($_GET["SECTION_ID"]);
$elementID = intval($_GET["ID"]);

if($sectionID > 0)
{
    $search_section = CIBlockSection::GetList(
        array(),
        array(
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => IBLOCK_PRODUCTS,
            'ID' => $sectionID
        )
    )->GetNext();

    if(empty($search_section))
    {
        LocalRedirect("/catalog.php");
    }
}
if ($elementID > 0) {
    $arElement = CIBlockElement::GetList(
        array(),
        array(
            'IBLOCK_ID' => IBLOCK_PRODUCTS,
            'SECTION_ID' => $sectionID,
            'ID' => $elementID
        ),
        false,
        false,
        [
            'ID', 'IBLOCK_ID','IBLOCK_SECTION_ID', 'NAME', 'DETAIL_PICTURE', 'SECTION_ID', 'CATALOG_GROUP_1'
        ]
    )->GetNextElement();
    if(empty($arElement))
    {
        LocalRedirect("/catalog.php");
    }
}
$arFields = $arElement->GetFields();
$arProps = $arElement->GetProperties();
foreach($arProps as $property_id => $property)
{
    $arProps[$property_id] = CIBlockFormatProperties::GetDisplayValue($arFields, $property);
}
$arFields['DETAIL_PICTURE'] = CFile::GetPath($arFields["DETAIL_PICTURE"]);
$arFields['PROPERTIES'] = $arProps;
$arResult[] = $arFields;
CJSCore::Init(array("fx"));
CJSCore::Init(array("ajax"));
$this->IncludeComponentTemplate();
?>