<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->IncludeComponent("my:test", ".default", array(

    "NAME" => "",
    "ARTNUMBER" => "",
    /*
    "DETAIL_PICTURE" => "",
    "PROPERTY_VALUES" => [
        "DESCRIPTION" => "",
        "BRAND_REF" => "",
        "MANUFACTURER" => "",
    ],*/





), false);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>