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

/*if (!empty($_GET["find_section_section"])) //SECTION_ID
{ echo " Получены новые вводные: имя - ".$_GET["find_section_section"]."";}
else { echo "Переменные не дошли. Проверьте все еще раз."; }*/
if ((empty($_GET["find_section_section"]))&&(empty($_GET["IBLOCK_ID"]))) //SECTION_ID
{
    LocalRedirect("/404.php", "404 Not Found");
}
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
function if_est_block($iblock_sec_id)
{
    $arFilter = array(
        'IBLOCK_ID' => IBLOCK_PRODUCTS,
        'SECTION_ID' => $iblock_sec_id
    );
    $serchSect = CIBlockSection::GetList(
        array(),
        $arFilter
    );
    $arr=[];
    while ($arraySect = $serchSect->GetNext())
    {
       /* echo '<pre>';
        print_r($arraySect);
        echo '</pre>';*/
       $arr[$arraySect['IBLOCK_SECTION_ID']][$arraySect['ID']]= [
            'ID'=> $arraySect['ID'],
            'NAME'=> $arraySect['NAME'],
            'IBLOCK_ID' => $arraySect['IBLOCK_ID'],
            'IBLOCK_SECTION_ID'=> $arraySect['IBLOCK_SECTION_ID'],
        ];
        //echo '<pre>';
        //print_r($arraySect);
        //echo '</pre>';
    }
    return $arr;
}
$arFilter = array(
    'IBLOCK_ID' => IBLOCK_PRODUCTS,
    'SECTION_ID' => $section_id
);
$ss = CIBlockSection::GetList(
    array(),
    $arFilter
);
$arr=[];
$arr = $ss->GetNext();
echo '<pre>';
//print_r($arr);
echo '</pre>';
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
$flag = true;
while ($arSection = $rsSection->GetNext()) {
    echo '<pre>';
    //print_r($arSection);
    echo '</pre>';
    if ($arSection['ID'] == $section_id) {
        $arResult = [
            'NAME' => $arSection['NAME'],
            'IBLOCK_SECTION_ID' => "",
            'SUBSECTION' => [],
        ];
        $arFilter = array(
            'IBLOCK_ID' => IBLOCK_PRODUCTS,
            'SECTION_ID' => $section_id
        );
        $serchSect = CIBlockSection::GetList(
            array(),
            $arFilter
        );
        while ($arraySect = $serchSect->GetNext()) {
            $arResult['SUBSECTION'][$arraySect['ID']] = [
                'NAME' => $arraySect['NAME'],
                'IBLOCK_ID' => $arraySect['IBLOCK_ID'],
                'ID' => $arraySect['ID']
            ];
            //print_r($arraySect['ID']);
            echo '<pre>';
            //print_r($id);
            echo '</pre>';
        }
        //print_r($arraySect['ID']);
    }
}
    if($ar['ID'] == $section_id)
    {
        $rsElement = CIBlockElement::GetList(
            array(),
            array(
                'IBLOCK_ID' => IBLOCK_PRODUCTS,
                'SECTION_ID' => $section_id,
            ),
            false,
            false,
            [
                'ID', 'IBLOCK_ID','IBLOCK_SECTION_ID', 'NAME', 'DETAIL_PICTURE', 'SECTION_ID',
                'PROPERTY_ARTNUMBER',
                'PROPERTY_MANUFACTURER',
                'PROPERTY_DESCRIPTION',
                'PROPERTY_BRAND_REF',
                'PROPERTY_*'
            ]
        );

        $boo = false;
        while($arElement = $rsElement->GetNext())
        {
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
                    'UF_XML_ID' => $arElement["PROPERTY_BRAND_REF_VALUE"]
                )
            ));
            $array_brend = $brand_result->Fetch()['UF_NAME'];
            //print_r(CFile::GetFileArray($arElement["DETAIL_PICTURE"]));
            //print_r(CFile::GetPath($arElement["DETAIL_PICTURE"]));
            // $rCIBlockElement::GetList(array(),array("DESCRIPTION"=>$arElement["DESCRIPTION"]));
            //$arviv = $r->GetNext();
            //print_r($arviv);
            //print_r($arElement["PROPERTY_BRAND_REF_VALUE"]);
            /*$arFilter = array(
                'IBLOCK_ID' => IBLOCK_PRODUCTS,
                'ID' => $arElement['IBLOCK_SECTION_ID']
            );
            $rs = CIBlockSection::GetList(
                array(),
                $arFilter
            );
            $ar = $rs->GetNext();
            //print_r($ar);*/
            $arProduct = [
                'NAME' => $arElement["NAME"],
                'DESCRIPTION' => $arElement["PROPERTY_DESCRIPTION_VALUE"],
                'ARTNUMBER' => $arElement["PROPERTY_ARTNUMBER_VALUE"],
                'MANUFACTURER' => $arElement["PROPERTY_MANUFACTURER_VALUE"],
                'DETAIL_PICTURE' =>  CFile::GetPath($arElement["DETAIL_PICTURE"]),
                'BRAND' => $array_brend,
                'IBLOCK_ID' => $arElement['IBLOCK_ID'],
                'IBLOCK_SECTION_ID' => $arElement['IBLOCK_SECTION_ID'],
                'ID' => $arElement['ID'],
                'NAMESECTION'=> $ar['NAME'],
                'PODSECTION' => [],
            ];
           $id=[];
            if($flag == true)
            {
                $id=if_est_block($_GET["find_section_section"]);
                $arProduct['PODSECTION'] = $id;
                //while(if_est_block($arProduct['IBLOCK_SECTION_ID'])!=false)
                //$id=if_est_block($arProduct['IBLOCK_SECTION_ID']);
                $flag = false;
            }

            $arResult[] = $arProduct;
            //$arResult[]= $id;
            $boo = true;
        }
        if(($arElement = $rsElement->GetNext()==false)&&($boo==false))
        {
            $arProduct=[
                'NAME' => '',
                'IBLOCK_SECTION_ID' => $section_id,
                'NAMESECTION'=> $ar['NAME'],
                'PODSECTION' => []
                ];
            $id=if_est_block($_GET["find_section_section"]);
            $arProduct['PODSECTION'] = $id;
            /*
            $arFilter = array(
                'IBLOCK_ID' => IBLOCK_PRODUCTS,
                'ID' => $section_id
            );
            $rs = CIBlockSection::GetList(
                array(),
                $arFilter
            );
            $ar = $rs->GetNext();*/
            /*$arProduct=[
                'NAMESECTION'=> $ar['NAME'],
                'PODSECTION' => [
                    $section_id =>[

                    ]
                    'NAME'=>$arr['NAME'],
                    'IBLOCK_SECTION_ID'=>$arr['IBLOCK_SECTION_ID'],
                    'IBLOCK_ID' => $arr['IBLOCK_ID']
                ],

            ];*/
            $arResult[] = $arProduct;
        }
}
echo '<pre>';
//print_r($arSect);
echo '</pre>';
   // LocalRedirect("/404.php", "404 Not Found");
//$arResult = array_merge($arResult,$arElement);
$this->IncludeComponentTemplate(); // <- $arResult

?>