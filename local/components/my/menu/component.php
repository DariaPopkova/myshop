<?php
CModule::IncludeModule('iblock');
define('IBLOCK_PRODUCTS', 4);

$arResult = [];
$arSections = [];
$arMenu = [];

$rsSection = CIBlockSection::GetList(
    array(),
    array(

        'IBLOCK_ID' => IBLOCK_PRODUCTS,

    ),

    [
        'ID', 'IBLOCK_ID', 'NAME', 'IBLOCK_SECTION_ID'
    ],
    false

);

while ($section = $rsSection->fetch())
{
    $arSections[] = $section;
}

foreach($arSections as $section)
{
    if (empty($section['IBLOCK_SECTION_ID']))
    {
        $arMenu[$section['ID']] = [
            'ID' => $section['ID'],
            'NAME' => $section['NAME'],
            'CHILDRENS' => []
        ];
    }
}

foreach($arSections as $section)
{
    if ( ! empty($section['IBLOCK_SECTION_ID']) && isset($arMenu[$section['IBLOCK_SECTION_ID']]))
    {
        $arMenu[$section['IBLOCK_SECTION_ID']]['CHILDRENS'][$section['ID']] = [
            'ID' => $section['ID'],
            'NAME' => $section['NAME']
        ];
    }
}

$arResult = $arMenu;
echo '<pre>';
//print_r($arResult);
echo '</pre>';



$this->IncludeComponentTemplate();
