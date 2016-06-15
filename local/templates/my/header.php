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
            <div id="logo"></div>
            <div id="phone"></div>
            <div id="reg"></div>
        </header>
        <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small","saleBasket",Array(
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
        $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            )
        );
        ?>
        <?$APPLICATION->IncludeComponent("bitrix:menu.sections","",Array(
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
        //echo '<pre>';
        //print_r($payment);
        //echo '</pre>';
        //$_SERVER['HTTP_ACCEPT']!!!!!!!!
        print_r($_SERVER['REQUEST_URI']);
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
            foreach($delivery as $elem_delivery)
            {
                $ar_fields["DELIVERY2PAY_SYSTEM"] = array(
                    $elem_delivery => $payment
                );
            }
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
