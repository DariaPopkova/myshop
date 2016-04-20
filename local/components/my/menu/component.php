<?php
CModule::IncludeModule('iblock');
define('IBLOCK_PRODUCTS', 4);
$rsSection =CIBlockSection::GetList(
    array(),
    array(

        'IBLOCK_ID' => IBLOCK_PRODUCTS,

    ),

    [
        'ID', 'IBLOCK_ID', 'NAME', 'IBLOCK_SECTION_ID', 'SUBSECTION'
    ],
    false

);
while($arSection = $rsSection->GetNext()) {

    $arRazdel['NAME'] = $arSection['NAME'];
    $arRazdel['IBLOCK_SECTION_ID'] = $arSection['IBLOCK_SECTION_ID'];
    $arRazdel['ID'] = $arSection['ID'];
    $arRazdel['SUBSECTION'] = $arSection['SUBSECTION'];
    $arResult[] = $arRazdel;
}
$this->IncludeComponentTemplate();
