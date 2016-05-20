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
while($array_brend = $brand_result->Fetch())
{
    $massiv_brend[$array_brend['UF_XML_ID']] = $array_brend;
   // $xml_id[$array_brend['UF_NAME']] = $array_brend['UF_XML_ID'];
}
if (($_GET["IBLOCK_ID"])&&(empty($_GET["find_section_section"])))
{
    $arResult['BRAND'] = $massiv_brend;
}
else
{
    $rsElement = CIBlockElement::GetList(
        array(),
        array(
            'IBLOCK_ID' => $_GET["IBLOCK_ID"],
            'SECTION_ID' => $_GET["find_section_section"],
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

        foreach($massiv_brend as $xml_id)
        {
            if(!empty($_GET['ELEMENT_ID']))
            {
                if($_GET['ELEMENT_ID'] === $arElement['ID'])
                {
                    if ($xml_id['UF_XML_ID'] === $arElement['PROPERTY_BRAND_REF_VALUE']) {
                        $arResult['BRAND'][$xml_id['UF_XML_ID']] = $xml_id;
                    }
                }
            }
            else {
                if ($xml_id['UF_XML_ID'] === $arElement['PROPERTY_BRAND_REF_VALUE']) {
                    $arResult['BRAND'][$xml_id['UF_XML_ID']] = $xml_id;
                }
            }
        }



    }

}









/*

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
        $arResult[$array_brend['UF_XML_ID']] = $array_brend; //['UF_NAME']
    }

}
if($_GET["find_section_section"]) {
    $section_id = $_GET["find_section_section"];
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
                    $arResult[$array_brend['UF_XML_ID']] = $array_brend; //['UF_NAME']

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

                $arResult[$array_brend['UF_XML_ID']] = $array_brend; //['UF_NAME']

            }

        }
    }
}*/


echo '<pre>';
//print_r($arSect);
echo '</pre>';
// LocalRedirect("/404.php", "404 Not Found");
//$arResult = array_merge($arResult,$arElement);
$this->IncludeComponentTemplate(); // <- $arResult

?>