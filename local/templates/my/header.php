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
            <div id="vremy">
                Канцтовары
            </div>
            <div id="reg">

            </div>
            <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line","",Array(
                    "HIDE_ON_BASKET_PAGES" => "Y",
                    "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                    "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                    "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                    "PATH_TO_PROFILE" => SITE_DIR."personal/",
                    "PATH_TO_REGISTER" => SITE_DIR."login/",
                    "POSITION_FIXED" => "Y",
                    "POSITION_HORIZONTAL" => "right",
                    "POSITION_VERTICAL" => "top",
                    "SHOW_AUTHOR" => "Y",
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
                    "SHOW_TOTAL_PRICE" => "Y"
                )
            );?>
            <?$APPLICATION->IncludeComponent(
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
                    "PATH_TO_ORDER" => "/personal/order.php",
                    "PRICE_VAT_SHOW_VALUE" => "N",
                    "QUANTITY_FLOAT" => "N",
                    "SET_TITLE" => "Y",
                    "TEMPLATE_THEME" => "blue",
                    "USE_GIFTS" => "Y",
                    "USE_PREPAYMENT" => "N"
                )
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:sale.order.ajax",
                "",
                Array(
                    "ALLOW_NEW_PROFILE" => "Y",
                    "SHOW_PAYMENT_SERVICES_NAMES" => "Y",
                    "SHOW_STORES_IMAGES" => "N",
                    "PATH_TO_BASKET" => "basket.php",
                    "PATH_TO_PERSONAL" => "index.php",
                    "PATH_TO_PAYMENT" => "payment.php",
                    "PATH_TO_AUTH" => "/auth/",
                    "PAY_FROM_ACCOUNT" => "Y",
                    "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
                    "COUNT_DELIVERY_TAX" => "N",
                    "ALLOW_AUTO_REGISTER" => "N",
                    "SEND_NEW_USER_NOTIFY" => "Y",
                    "DELIVERY_NO_AJAX" => "N",
                    "DELIVERY_NO_SESSION" => "N",
                    "TEMPLATE_LOCATION" => ".default",
                    "DELIVERY_TO_PAYSYSTEM" => "d2p",
                    "SET_TITLE" => "Y",
                    "USE_PREPAYMENT" => "N",
                    "DISABLE_BASKET_REDIRECT" => "Y",
                    "PRODUCT_COLUMNS" => array("DISCOUNT_PRICE_PERCENT_FORMATED", "WEIGHT_FORMATED"),
                    "PROP_1" => array(),
                    "PROP_2" => array()
                )
            );?>
            <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small","",Array(
                    "PATH_TO_BASKET" => "/personal/basket.php",
                    "PATH_TO_ORDER" => "/personal/order.php",
                    "SHOW_DELAY" => "Y",
                    "SHOW_NOTAVAIL" => "Y",
                    "SHOW_SUBSCRIBE" => "Y"
                )
            );?>

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
                $APPLICATION->IncludeComponent("my:hlebnav", ".default", Array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => "s1"
                    )
                );
            ?>



        <article>