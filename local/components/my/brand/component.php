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
if ((empty($_GET["find_section_section"]))&&(empty($_GET["IBLOCK_ID"]))) //SECTION_ID
{
    LocalRedirect("/404.php", "404 Not Found");
}

/*
function brand_search($arFilter){
    $brandDataClass = HL\HighloadBlockTable::compileEntity(
        HL\HighloadBlockTable::getById(HLIBLOCK_BRANDS)
            ->fetch()
    )->getDataClass();
    $brand_result = $brandDataClass::getList(array(
        array(
            'ID',
            'UF_NAME',
            'UF_XML_ID'
        ),
        array(),
        $arFilter,
    ));
    $arr = [];
    while($array_brend = $brand_result->Fetch()){
        $arr[$brand_result['ID']] = $array_brend ;
    }
    return $arr;
}*/
/*if (!empty($_GET["find_section_section"])) //SECTION_ID
{ echo " Получены новые вводные: имя - ".$_GET["find_section_section"]."";}
else { echo "Переменные не дошли. Проверьте все еще раз."; }*/
if (($_GET["IBLOCK_ID"])&&(empty($_GET["find_section_section"]))) //SECTION_ID
{
    $arFilterBr = array();
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
    $xml_brand = [];
    while($array_brend = $brand_result->Fetch())
    {
        $arResult[$array_brend['UF_XML_ID']] = $array_brend['UF_NAME'];
    }

}
if($_GET["find_section_section"]) {
    $section_id = $_GET["find_section_section"];
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
    $arFilter = array(
        'IBLOCK_ID' => IBLOCK_PRODUCTS,
        'SECTION_ID' => '',
        'ID' =>$section_id
    );

    $rsSection = CIBlockSection::GetList(
        array(),
        $arFilter
    );
    if ($arSection = $rsSection->GetNext()) {
        $arFilter = array(
            'IBLOCK_ID' => IBLOCK_PRODUCTS,
            'SECTION_ID' => $section_id
        );
        $serchSect = CIBlockSection::GetList(
            array(),
            $arFilter
        );
        while ($arraySect = $serchSect->GetNext()) {
            $rsElement = CIBlockElement::GetList(
                array(),
                array(
                    'IBLOCK_ID' => IBLOCK_PRODUCTS,
                    'SECTION_ID' => $arraySect['ID'],
                ),
                false,
                false,
                [
                    'ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'XML_ID', 'NAME', 'DETAIL_PICTURE', 'SECTION_ID',
                    'PROPERTY_ARTNUMBER',
                    'PROPERTY_MANUFACTURER',
                    'PROPERTY_DESCRIPTION',
                    'PROPERTY_BRAND_REF',
                    'PROPERTY_*'
                ]
            );
            while ($arElement = $rsElement->GetNext()){
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
                        'UF_XML_ID' => $arElement['PROPERTY_BRAND_REF_VALUE']
                    )
                ));
                $massiv_brend = [];
                $xml_brand = [];
                while ($array_brend = $brand_result->Fetch()) {
                    echo '<pre>';
                    //print_r($array_brend);
                    echo '</pre>';
                    $arResult[$array_brend['UF_XML_ID']] = $array_brend['UF_NAME'];

                }
            }
                //print_r($arraySect['ID']);
            echo '<pre>';
            //print_r($id);
            echo '</pre>';
        }
    }
    else {
        $rsElement = CIBlockElement::GetList(
            array(),
            array(
                'IBLOCK_ID' => IBLOCK_PRODUCTS,
                'SECTION_ID' => $section_id,
            ),
            false,
            false,
            [
                'ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'XML_ID', 'NAME', 'DETAIL_PICTURE', 'SECTION_ID',
                'PROPERTY_ARTNUMBER',
                'PROPERTY_MANUFACTURER',
                'PROPERTY_DESCRIPTION',
                'PROPERTY_BRAND_REF',
                'PROPERTY_*'
            ]
        );
        while ($arElement = $rsElement->GetNext()) {
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
                    'UF_XML_ID' => $arElement['PROPERTY_BRAND_REF_VALUE']
                )
            ));
            $massiv_brend = [];
            $xml_brand = [];
            while ($array_brend = $brand_result->Fetch()) {
                echo '<pre>';
                //print_r($array_brend);
                echo '</pre>';

                $arResult[$array_brend['UF_XML_ID']] = $array_brend['UF_NAME'];

            }

        }
    }
}

/*
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
$arFilter = array(
    'IBLOCK_ID' => IBLOCK_PRODUCTS,
    'ID' => $section_id
);
$sser = CIBlockSection::GetList(
    array(),
    $arFilter
);
$ar=[];
$ar = $sser->GetNext();
echo '<pre>';
//print_r($ar);
echo '</pre>';
$arFilter = array(
    'IBLOCK_ID' => IBLOCK_PRODUCTS,
    'SECTION_ID' => ''
);
$rsSection = CIBlockSection::GetList(
    array(),
    $arFilter
);
while ($arSection = $rsSection->GetNext())
{
    $arFil = array(
        'IBLOCK_ID' => IBLOCK_PRODUCTS,
        'IBLOCK_SECTION_ID' => $arSection['ID']
    );
    $rsSect = CIBlockSection::GetList(
        array(),
        $arFilter
    );
    while($arPodS = $rsSect -> GetNext())
    {
        echo '<pre>';
        //print_r($arPodS);
        echo '</pre>';
    }


    echo '<pre>';
    //print_r($arSection);
    echo '</pre>';

}
$arResult[] = $arProduct;*/
echo '<pre>';
//print_r($arSect);
echo '</pre>';
// LocalRedirect("/404.php", "404 Not Found");
//$arResult = array_merge($arResult,$arElement);
$this->IncludeComponentTemplate(); // <- $arResult

?>