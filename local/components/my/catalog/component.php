<?
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

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
if((empty($_GET["find_section_section"]))&&(empty($_GET["IBLOCK_ID"]))&&(empty($_GET["brand_id"]))) //SECTION_ID
{
    LocalRedirect("/404.php", "404 Not Found");
}
else{
    if(!empty($_GET["IBLOCK_ID"]))
    {
        $res = CIBlock::GetList(
            Array(),
            Array(
                'ID' => $_GET["IBLOCK_ID"]
            ), true
        );
        $ar_res = $res->Fetch();
        if(empty($ar_res))
        {
            LocalRedirect("/404.php", "404 Not Found");
        }
    }
    if(!empty($_GET["find_section_section"]))
    {
        $search_section = CIBlockSection::GetList(
            array(),
            array(
                'ID' => $_GET["find_section_section"]
            )
        );
        $arsec = $search_section->GetNext();
        if(empty($arsec))
        {
            LocalRedirect("/404.php", "404 Not Found");
        }
    }
    if(!empty($_GET["brand_id"]))
    {
        $brand_result = $brandDataClass::getList(array(
            "select" => array(
                'ID',
                'UF_NAME',
                'UF_XML_ID'
            ),
            "order" => array(),
            "filter" => array(
                'ID' => $_GET['brand_id']
            )
        ));
        $array_brend = $brand_result->Fetch();
        if(empty($array_brend))
        {
            LocalRedirect("/404.php", "404 Not Found");
        }
    }

}
$section_id = $_GET["find_section_section"];
if((!is_numeric($section_id) && intval($section_id) < 0)&&(!is_numeric($_GET["IBLOCK_ID"]) && intval($_GET["IBLOCK_ID"]) < 0)&&(!is_numeric($_GET["brand_id"]) && intval($_GET["brand_id"]) < 0))
{
    LocalRedirect("/404.php", "404 Not Found");
}
$arFilter_for_section = array(
    'IBLOCK_ID' => IBLOCK_PRODUCTS,
    'ID' => $section_id
);
$glav_section = CIBlockSection::GetList(
    array(),
    $arFilter_for_section
);
$arSection=[];
$arSection = $glav_section->GetNext();
$arResult['NAMESECTION']['NAME'] = $arSection['NAME'];
$arFilter_for_podsection = array(
    'IBLOCK_ID' => IBLOCK_PRODUCTS,
    'SECTION_ID' => $section_id
);
$podsection = CIBlockSection::GetList(
    array(),
    $arFilter_for_podsection
);
$arPodsection=[];
while($arPodsection = $podsection->GetNext())
{
    $arResult['SECTIONS'][] = $arPodsection;
}
$searchElement = CIBlockElement::GetList(
    array(),
    array(
        'IBLOCK_ID' => IBLOCK_PRODUCTS,
        'SECTION_ID' => $section_id,
        "INCLUDE_SUBSECTIONS"=>"Y"
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
while($arElement = $searchElement->GetNext()) {
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
    $array_brend = $brand_result->Fetch();
    $arProduct = [
        'NAME' => $arElement["NAME"],
        'DESCRIPTION' => $arElement["PROPERTY_DESCRIPTION_VALUE"],
        'ARTNUMBER' => $arElement["PROPERTY_ARTNUMBER_VALUE"],
        'MANUFACTURER' => $arElement["PROPERTY_MANUFACTURER_VALUE"],
        'DETAIL_PICTURE' => CFile::GetPath($arElement["DETAIL_PICTURE"]),
        'BRAND' => $array_brend['UF_NAME'],
        'IBLOCK_ID' => $arElement['IBLOCK_ID'],
        'IBLOCK_SECTION_ID' => $arElement['IBLOCK_SECTION_ID'],
        'ID' => $arElement['ID'],

    ];
    //$arResult['PRODUCTS'][] = $arProduct;
    if(!empty($_GET['brand_id']))
    {
        if($_GET['brand_id']==$array_brend['ID'])
        {
            $arResult['PRODUCTS'][] = $arProduct;
        }
    }
    else{
        if($arElement['IBLOCK_SECTION_ID'] === $section_id)
        {
            $arResult['PRODUCTS'][] = $arProduct;
        }
    }

}
//INCLUDE_SUBSECTIONS
$this->IncludeComponentTemplate(); // <- $arResult

?>