<?
$ar_fields = array(
    "PATH_TO_BASKET" => "/personal/cart/",
    "ALLOW_PAY_FROM_ACCOUNT" => "Y",
    "SHOW_MENU" => "Y",
    "USE_AJAX_LOCATIONS" => "Y",
    "SHOW_AJAX_DELIVERY_LINK" => "N",
    "CITY_OUT_LOCATION" => "Y",
    "COUNT_DELIVERY_TAX" => "N",
    "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
    "SET_TITLE" => "Y",
    "PRICE_VAT_INCLUDE" => "Y",
    "PRICE_VAT_SHOW_VALUE" => "Y",
    "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
    "DELIVERY_NO_SESSION" => "N",

);
foreach($delivery as $elem_delivery)
{
    $ar_fields["DELIVERY2PAY_SYSTEM"] = array(
        $elem_delivery => $payment
    );
}
$APPLICATION->IncludeComponent(
    "bitrix:sale.order.ajax",
    ".default",
    $ar_fields
);
?>