<?
CModule::IncludeModule("iblock");
define('IBLOCK_PRODUCTS', 4);
function block($iblock_sec_id)
{
    $arFilter = array(
        'IBLOCK_ID' => IBLOCK_PRODUCTS,
        'ID' => $iblock_sec_id
    );
    $serchSect = CIBlockSection::GetList(
        array(),
        $arFilter
    );
    $arraySect = $serchSect->GetNext();
    if (empty($arraySect['IBLOCK_SECTION_ID'])) {
        return false;
    } else {
        return $arraySect;
    }
}
if(!empty($_GET['find_section_section'])) {
    $sect = $_GET['find_section_section'];
    $i = true;
    $sections = [];
    $k = 1;
    while ($i !== false) {
        $i = block($sect);
        $arPS = array(
            'IBLOCK_ID' => 4,
            'ID' => $sect
        );
        $rsPS = CIBlockSection::GetList(
            array(),
            $arPS
        );
        $arPodSec = $rsPS->GetNext();
        if ($i != false) {
            $sections[$k] = [
                'NAME' => $arPodSec['NAME'],
                'ID' => $arPodSec['ID']
            ];
        } else {
            $sections[$k] = [
                'NAME' => $arPodSec['NAME'],
                'ID' => $arPodSec['ID']
            ];
        }
        $k++;
        $sect = $i['IBLOCK_SECTION_ID'];
    }
    $arResult[] = $sections;
}

/*
CModule::IncludeModule("iblock");
$sectionID = intval($_GET['SECTION_ID']);
if($sectionID > 0) {
    $arFilter = array(
        'IBLOCK_ID' => IBLOCK_PRODUCTS,
        'ID' => $sectionID
    );
    $serchSect = CIBlockSection::GetList(
        array(),
        $arFilter
    );
    $arraySect = $serchSect->GetNext();
    $arResult[$arraySect['DEPTH_LEVEL']] = $arraySect;
    echo '<pre>';
    print_r($arraySect);
    echo '</pre>';*/
   /* while($arraySect['DEPTH_LEVEL'])
    {
        $arFilter = array(
            'IBLOCK_ID' => IBLOCK_PRODUCTS,
            'ID' => $arraySect['IBLOCK_SECTION_ID']
        );
        $arraySect = CIBlockSection::GetList(
            array(),
            $arFilter
        )->GetNext();
    }*/
    /*
    if (empty($arraySect['IBLOCK_SECTION_ID'])) {
        return false;
    } else {
        return $arraySect;
    }
    $i = true;
    $sections = [];
    $k = 1;
    while ($i !== false) {
        $i = block($sectionID);
        $arPS = array(
            'IBLOCK_ID' => IBLOCK_PRODUCTS,
            'ID' => $sectionID
        );
        $rsPS = CIBlockSection::GetList(
            array(),
            $arPS
        );
        $arPodSec = $rsPS->GetNext();
        if ($i != false) {
            $sections[$k] = [
                'NAME' => $arPodSec['NAME'],
                'ID' => $arPodSec['ID']
            ];
        } else {
            $sections[$k] = [
                'NAME' => $arPodSec['NAME'],
                'ID' => $arPodSec['ID']
            ];

        }
        $k++;
        $sect = $i['IBLOCK_SECTION_ID'];
    }
    $arResult[] = $sections;*/


$this->IncludeComponentTemplate();
?>