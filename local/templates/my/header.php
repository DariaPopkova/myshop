<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <!--<script type="text/javascript" src="jquery.js"></script>-->
    <?CJSCore::Init(array("jquery"));?>
    <?$APPLICATION->ShowHead();?>
    <?//$APPLICATION->SetAdditionalCSS('/путь/стиль.css'); // для стилей?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"  type="text/javascript"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->


    <!--<script src="/local/templates/my/components/bitrix/sale.basket.basket/templates/.default/script.js"></script>-->
    <title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>

<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div id="wrapper">
    <div id="firstcreen">
        <header>
            <div id="logo"></div>
            <div id="phone"></div>
            <div id="reg"></div>
        </header>
        <?$APPLICATION->IncludeComponent(
            "bitrix:sale.basket.basket.small",
            "saleBasket",
            Array(
                "PATH_TO_BASKET" => "/personal/cart/",
                "PATH_TO_ORDER" => "/cart.php",
                "SHOW_DELAY" => "N",
                "SHOW_NOTAVAIL" => "N",
                "SHOW_SUBSCRIBE" => "N"
            )
        );
        ?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "horizontal_multilevel",
            Array(
                "ROOT_MENU_TYPE" => "top",
                "MAX_LEVEL" => "2",
                "CHILD_MENU_TYPE" => "left",
                "USE_EXT" => "Y"
            )
        );
        ?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "",
            Array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            )
        );
        ?>
        <article>
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu.sections",
            "",
            Array(
                "IS_SEF" => "Y",
                "SEF_BASE_URL" => "/catalog/phone/",
                "SECTION_PAGE_URL" => "#SECTION_ID#/",
                "DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#",
                "IBLOCK_TYPE" => "news",
                "IBLOCK_ID" => "1",
                "DEPTH_LEVEL" => "1",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600"
            )
        );?>


