<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
echo '<pre>';
print_r($arParams);
echo '</pre>';
CModule::IncludeModule('iblock');

$name = $arParams['NAME'];
$art = $arParams['ARTNUMBER'];
$color = $arParams['DESCRIPTION'];
$brand = $arParams['BRAND_REF'];
$manuf = $arParams['MANUFACTURER'];
$picture = $arParams['DETAIL_PICTURE'];


$db_list = CIBlockElement::GetList(
    array(),
    array(
        'IBLOCK_ID' => 4,
        'IBLOCK_SECTION_ID' => 35,
        'NAME' => $name,
        'ARTNUMBER' => $art,
        'DESCRIPTION' => $color,
        'BRAND_REF' => $brand,
        'MANUFACTURER' => $manuf,
        'DETAIL_PICTURE' => $picture,





    ),
    false,
    false,
    array("NAME")
);
while ($ar_result = $db_list->GetNext()) {
    $arResult[] = array(
        "NAME" => $ar_result['NAME'],
        "ARTNUMBER" => $ar_result['ARTNUMBER'],
        "DESCRIPTION" => $ar_result['DESCRIPTION'],
        "BRAND_REF" => $ar_result['BRAND_REF'],
        "MANUFACTURER" => $ar_result['MANUFACTURER'],
        "DETAIL_PICTURE" => $ar_result['DETAIL_PICTURE'],
    );

}


echo '<pre>';
print_r($arResult);
echo '</pre>';
$this->IncludeComponentTemplate();

?>