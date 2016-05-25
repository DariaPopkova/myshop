<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <script type="text/javascript" src="jquery.js"></script>
    <?$APPLICATION->ShowHead();?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>

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

            <div id="reg">

            </div>

            <?//Одностраничный компонент, который отображает специальный блок корзины.
            $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line","",Array(
                    "HIDE_ON_BASKET_PAGES" => "Y",
                    //"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                    "PATH_TO_BASKET" => SITE_DIR."basket.php",
                    //"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                    "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                    "PATH_TO_PROFILE" => SITE_DIR."personal/",
                    "PATH_TO_REGISTER" => SITE_DIR."login/",
                    "POSITION_FIXED" => "Y",
                    "POSITION_HORIZONTAL" => "right",
                    "POSITION_VERTICAL" => "top",
                    //"SHOW_AUTHOR" => "Y",
                    "SHOW_DELAY" => "N",
                    "SHOW_EMPTY_VALUES" => "Y",
                    "SHOW_IMAGE" => "Y",
                    "SHOW_NOTAVAIL" => "N",
                    "SHOW_NUM_PRODUCTS" => "Y",
                    "SHOW_PERSONAL_LINK" => "N",
                    "SHOW_PRICE" => "Y",
                    "SHOW_PRODUCTS" => "Y",
                    "SHOW_SUBSCRIBE" => "Y",
                    "SHOW_SUMMARY" => "Y",
                    "SHOW_TOTAL_PRICE" => "Y",

                )
            );?>
           
            <?//Сама корзина. Одностраничный компонент отображает список товаров, отправленных пользователем в корзину.
            /*$APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket",
                "",
                Array(
                    "ACTION_VARIABLE" => "action",
                    "COLUMNS_LIST" => array("NAME","DISCOUNT","WEIGHT","DELETE","DELAY","TYPE","PRICE","QUANTITY"),
                    "COMPONENT_TEMPLATE" => ".default",
                    "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
                    "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
                    "GIFTS_CONVERT_CURRENCY" => "Y",
                    "GIFTS_HIDE_BLOCK_TITLE" => "N",
                    "GIFTS_HIDE_NOT_AVAILABLE" => "N",
                    "GIFTS_MESS_BTN_BUY" => "Выбрать",
                    "GIFTS_MESS_BTN_DETAIL" => "Подробнее",
                    "GIFTS_PAGE_ELEMENT_COUNT" => "4",
                    "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
                    "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",
                    "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
                    "GIFTS_SHOW_IMAGE" => "Y",
                    "GIFTS_SHOW_NAME" => "Y",
                    "GIFTS_SHOW_OLD_PRICE" => "Y",
                    "GIFTS_TEXT_LABEL_GIFT" => "Подарок",
                    "HIDE_COUPON" => "N",
                    "OFFERS_PROPS" => array("SIZES_SHOES","SIZES_CLOTHES"),
                    //"PATH_TO_ORDER" => "/personal/order.php",
                    "PRICE_VAT_SHOW_VALUE" => "N",
                    "QUANTITY_FLOAT" => "N",
                    "SET_TITLE" => "Y",
                    "TEMPLATE_THEME" => "blue",
                    "USE_GIFTS" => "Y",
                    "USE_PREPAYMENT" => "N"
                )
            );*/?>

            <?//Малая корзина.Одностраничный компонент отображает все товары, которые находятся в корзине в различных состояниях.
            /*$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small","",Array(
                    "PATH_TO_BASKET" => "my/basket/",
                    "PATH_TO_ORDER" => "/personal/order.php",
                    "SHOW_DELAY" => "Y",
                    "SHOW_NOTAVAIL" => "Y",
                    "SHOW_SUBSCRIBE" => "Y"
                )
            );*/?>

        </header>

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

        /*
        if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
        CModule::IncludeModule("iblock");

        global $APPLICATION;
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
        $aMenuLinks = Array(
            Array(
                "Для офиса",
                "/catalog.php?SECTION_ID=16",
                Array(),
                Array(),
                ""
            ),

            Array(
                "Для творчества",
                "/catalog.php?SECTION_ID=17",
                Array(),
                Array(),
                ""
            ),

            Array(
                "Для школы",
                "/catalog.php?SECTION_ID=18",
                Array(),
                Array(),
                ""
            ),
        );
        $IBlock = CIBlock::GetList(
            Array(),
            Array(
                'ID' => IBLOCK_PRODUCTS
            ), true
        )->Fetch();
        $arFilter = array(
            'IBLOCK_ID'=>IBLOCK_PRODUCTS,
            );
        $db_list = CIBlockSection::GetList(
            array(),
            $arFilter
        );
        while($ar_list = $db_list->GetNext())
        {

            echo '<pre>';
            print_r($ar_list);
            echo '</pre>';
        }




        $aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
            "IS_SEF" => "N",
            "SEF_BASE_URL" => "",
            "ID" =>20,
            "SECTION_URL" => "/catalog.php?SECTION_ID=#SECTION_ID#",

            "IBLOCK_TYPE" => $IBlock['TYPE'],
            "IBLOCK_ID" => IBLOCK_PRODUCTS,
            "DEPTH_LEVEL" => "2",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000"
        ),
            false
        );

        $aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);*/


        /*$APPLICATION->IncludeComponent(
            "my:menu",
            ".default",
            array(

            ),
            false
        );*/

        ?>

            <?

            $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => "s1"
                )
            );

            ?>



        <article>