<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

array_map('CModule::IncludeModule', ['iblock','catalog', 'sale', 'highloadblock']);
/* Входные данные и валидация */
$sectionID = intval($_GET["SECTION_ID"]);
$brandID = intval($_GET["brand_id"]);
$brandXML_ID = false;

class Property
{
    public $arFilter;
    public $arResult;
    public function __construct()
    {

    }
    public function brand($brandID){
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
    }
    public function section($sectionID ){
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

            $this->arResult['SECTIONS'][] = array_merge(
                array(
                    'MAIN' => 'Y'
                ),
                $search_section
            );

            $this->arFilter = array(
                'SECTION_ID' => $sectionID
            );
        }

        /* Разделы каталога */


//$arResult['NAMESECTION']['NAME'] = $arSection['NAME'];
        $podsection = CIBlockSection::GetList(
            array(),
            array(
                'ACTIVE' => 'Y',
                'IBLOCK_ID' => IBLOCK_PRODUCTS,
                'SECTION_ID' => $sectionID
            )
        );
        while($arPodsection = $podsection->GetNext())
        {
            $this->arResult['SECTIONS'][] = $arPodsection;
        }
    }
}
$arrayFil = array(

);
$brand = new Property(
    array(
    'ID' => $brandID
    ),
    array()
);

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
    'IBLOCK_ID' => IBLOCK_PRODUCTS,
);
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
    $arResult['SECTIONS'][] = array_merge(
        array(
            'MAIN' => 'Y'
        ),
        $search_section
    );

    $arFilter['SECTION_ID'] = $sectionID;
}

/* Разделы каталога */


//$arResult['NAMESECTION']['NAME'] = $arSection['NAME'];
$podsection = CIBlockSection::GetList(
    array(),
    array(
        'ACTIVE' => 'Y',
        'IBLOCK_ID' => IBLOCK_PRODUCTS,
        'SECTION_ID' => $sectionID
    )
);
while($arPodsection = $podsection->GetNext())
{
    $arResult['SECTIONS'][] = $arPodsection;
}

/* Товары */

if(($sectionID !== 0)||($brandID !== 0))
{
    if (!empty($brandXML_ID))
    {
        $arFilter['PROPERTY_BRAND_REF'] = $brandXML_ID;
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

        $arFields['DETAIL_PICTURE'] = CFile::GetPath($arFields["DETAIL_PICTURE"]);
        $arFields['PROPERTIES'] = $arProps;

        $arResult['PRODUCTS'][] = $arFields;

    }
}
$arFilter = array(
    'IBLOCK_ID' => IBLOCK_PRODUCTS,
    'ID' =>  $sectionID
);
$serchSect = CIBlockSection::GetList(
    array(),
    $arFilter
)->GetNext();
$ar_novigation[] = $serchSect;
while($serchSect['DEPTH_LEVEL'] > 1)
{
    $arFilter = array(
        'IBLOCK_ID' => IBLOCK_PRODUCTS,
        'ID' => $serchSect['IBLOCK_SECTION_ID']
    );
    $serchSect = CIBlockSection::GetList(
        array(),
        $arFilter
    )->GetNext();
    array_unshift($ar_novigation,$serchSect);

}
foreach($ar_novigation as $hleb)
{
    $APPLICATION->AddChainItem($hleb['NAME'], "/catalog.php?SECTION_ID={$hleb['ID']}");
}
$this->IncludeComponentTemplate(); // <- $arResult