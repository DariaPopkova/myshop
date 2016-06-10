<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <script type="text/javascript" src="jquery.js"></script>
    <?$APPLICATION->ShowHead();?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"  type="text/javascript"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>


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
            /*
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
            );*/?>

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

            
        </header>
        <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small","saleBasket",Array(
                "PATH_TO_BASKET" => "/personal/cart/",
                "PATH_TO_ORDER" => "/cart.php",
                "SHOW_DELAY" => "N",
                "SHOW_NOTAVAIL" => "N",
                "SHOW_SUBSCRIBE" => "N"
            )
        );?>
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
           // print_r($_SERVER['REQUEST_URI']);
            ?>



        <?

        if (!CModule::IncludeModule("sale"))
        {
            ShowError(GetMessage("SALE_MODULE_NOT_INSTALL"));
            return;
        }

        $db_dtype = CSaleDelivery::GetList(
            array(
            ),
            array(
                "ACTIVE" => "Y",

            ),
            false,
            false,
            array()
        );
        if ($ar_dtype = $db_dtype->Fetch())
        {
            $delivery = [];
            do
            {
                $delivery[] = $ar_dtype["ID"];
                //echo $ar_dtype["NAME"]." - стоимость ".CurrencyFormat($ar_dtype["PRICE"], $ar_dtype["CURRENCY"])."<br>";
            }
            while ($ar_dtype = $db_dtype->Fetch());
        }
        else
        {
            //echo "Доступных способов доставки не найдено<br>";
        }

        $db_ptype = CSalePaySystem::GetList(
            array(),
            array(
                "CURRENCY"=>"RUB",
                "ACTIVE"=>"Y",
                "NAME" => 'Наличные курьеру'
            )
        );

        while ($ptype = $db_ptype->Fetch())
        {
            $payment[] = $ptype['ID'];

        }
        echo '<pre>';
        //print_r($payment);
        echo '</pre>';

        if($_SERVER['REQUEST_URI'] == '/personal/cart/')
        {
           $ar_fields = array(
                "PATH_TO_BASKET" => "/personal/cart/",
                "ALLOW_PAY_FROM_ACCOUNT" => "Y",
                "SHOW_MENU" => "Y",
                "USE_AJAX_LOCATIONS" => "Y",
                "SHOW_AJAX_DELIVERY_LINK" => "N",
                "CITY_OUT_LOCATION" => "Y",
                "COUNT_DELIVERY_TAX" => "Y",
                "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
                "SET_TITLE" => "Y",
                "PRICE_VAT_INCLUDE" => "Y",
                "PRICE_VAT_SHOW_VALUE" => "Y",
                "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",

                "DELIVERY_NO_SESSION" => "Y",



            );
            /*$ar_fields = array(
                "ALLOW_NEW_PROFILE" => "Y",
                    "SHOW_PAYMENT_SERVICES_NAMES" => "Y",
                    "SHOW_STORES_IMAGES" => "N",
                    "PATH_TO_BASKET" => "/personal/cart/",
                    "PAY_FROM_ACCOUNT" => "Y",
                    "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
                    "COUNT_DELIVERY_TAX" => "N",
                    "ALLOW_AUTO_REGISTER" => "N",
                    "SEND_NEW_USER_NOTIFY" => "Y",
                    "DELIVERY_NO_AJAX" => "N",
                    "DELIVERY_NO_SESSION" => "N",
                    //"TEMPLATE_LOCATION" => ".default",
                    "DELIVERY_TO_PAYSYSTEM" => "d2p",
                    "SET_TITLE" => "Y",
                    "USE_PREPAYMENT" => "N",
                    "DISABLE_BASKET_REDIRECT" => "Y",


                );*/
            foreach($delivery as $elem_delivery)
            {
                $ar_fields["DELIVERY2PAY_SYSTEM"] = array(
                    $elem_delivery => $payment
                );
                //print_r($ar_fields);
            }

            echo '<pre>';
           // print_r($delivery);
            echo '</pre>';
            /*$APPLICATION->IncludeComponent(
                "bitrix:sale.order.ajax",
                "",
                $ar_fields

            )*/;
            /*$APPLICATION->IncludeComponent(
                     "bitrix:sale.order.full",
                     "",
                     $ar_fields
                 );*/
       }


        ?>



        <article>