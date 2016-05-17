<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <script type="text/javascript" src="jquery.js"></script>
    <?$APPLICATION->ShowHead();?>

    <title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>

<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div id="wrapper">
    <div id="firstcreen">
        <header>
            <div id="logo">

            </div>
            <div id="phone">

            </div>
            <div id="vremy">

            </div>
            <div id="reg">

            </div>
        </header>
        <?
        $APPLICATION->IncludeComponent(
            "my:menu",
            ".default",
            array(
                "ROOT_MENU_TYPE" => "top",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "top",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => ""
            ),
            false
        );

        ?>
        <?
        if(!empty($_GET['find_section_section']))
        {
            CModule::IncludeModule("iblock");
            define('IBLOCK_PRODUCTS', 4);

            $sect = $_GET['find_section_section'];
            $ar = array(
                'IBLOCK_ID' => 4,
                'ID' => $sect
            );
            $rs = CIBlockSection::GetList(
                array(),
                $ar
            );
            $ars = $rs->GetNext();
            if(!empty($ars['IBLOCK_SECTION_ID']))
            {
                $arGS = array(
                    'IBLOCK_ID' => 4,
                    'ID' => $ars['IBLOCK_SECTION_ID']
                );
                $rsGS = CIBlockSection::GetList(
                    array(),
                    $arGS
                );
                $arGlavSect = $rsGS->GetNext();
                print_r($arGlavSect);
                $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(
                        "START_FROM" => "0",
                        "PATH" => "/catalog.php?IBLOCK_ID=4&find_section_section='".$arGlavSect['ID']."'",
                        "SITE_ID" => "s1"
                    )
                );
                $APPLICATION->AddChainItem($arGlavSect['NAME'], "/catalog.php?IBLOCK_ID=4&find_section_section='".$arGlavSect['ID']."'");
                $APPLICATION->AddChainItem($ars['NAME'], "/catalog.php?IBLOCK_ID=4&find_section_section='".$ars['ID']."'");

            }
            else{
                $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(
                        "START_FROM" => "0",
                        "PATH" => "/catalog.php?IBLOCK_ID=4&find_section_section='".$ars['ID']."'",
                        "SITE_ID" => "s1"
                    )
                );
                $APPLICATION->AddChainItem($ars['NAME'], "/catalog.php?IBLOCK_ID=4&find_section_section='".$ars['ID']."'");
            }















    /*
            $ar = array(
                'IBLOCK_ID' => 4,
                'ID' => $sect
            );
            $rs = CIBlockSection::GetList(
                array(),
                $ar
            );
            $ars = $rs->GetNext();
                $arFil = array(
                    'IBLOCK_ID' => 4,
                    'SECTION_ID' => ''
                );
                $rsSec = CIBlockSection::GetList(
                    array(),
                    $arFil
                );
                $gsect =[];
                while ($arSec = $rsSec->GetNext()) {
                    echo '<pre>';
                    print_r($arSec);
                    echo '</pre>';
                    $gsect[$arSec['ID']] = $arSec['NAME'];
                }
                print_r($gsect);
                $key = array_search($ars['NAME'], $gsect);
                if($key !== false)
                {
                    $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(
                            "START_FROM" => "0",
                            "PATH" => "/catalog.php?IBLOCK_ID=4&find_section_section='".$arSec['ID']."'",
                            "SITE_ID" => "s1"
                        )
                    );





                }

                $arFilter = array(
                    'IBLOCK_ID' => IBLOCK_PRODUCTS,
                    'ID' => $sect
                );
                $rsSection = CIBlockSection::GetList(
                    array(),
                    $arFilter
                );
                while ($arSection = $rsSection->GetNext()) {

                    $APPLICATION->AddChainItem($arSection['NAME'], "/catalog.php?IBLOCK_ID=4&find_section_section='".$arSection['ID']."'");
                    $arFilter = array(
                        'IBLOCK_ID' => IBLOCK_PRODUCTS,
                        'ID' => $sect
                    );
                    $rsSection = CIBlockSection::GetList(
                        array(),
                        $arFilter
                    );
                    while ($arSection = $rsSection->GetNext()) {}
                    //$gsect[$arSection['ID']] = $arSection;

                }*/

            /*$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(
                    "START_FROM" => "0",
                    "PATH" => "/catalog.php?IBLOCK_ID=4&find_section_section=16",
                    "SITE_ID" => "s1"
                )
            );

                $APPLICATION->AddChainItem("Для офиса", "/catalog.php?IBLOCK_ID=4&find_section_section=16");

            if ($_GET['find_section_section'] == 19) {
                $APPLICATION->AddChainItem("Бумага", "/catalog.php?IBLOCK_ID=4&find_section_section=19");*/
        }
        //my:hlebnav?>





        <article>