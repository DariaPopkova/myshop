<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->IncludeComponent("my:test", ".default", array(

    "NAME" => "Бумага IQ Allround",
    "ARTNUMBER" => "7748",
    "DESCRIPTION" => "",
    "BRAND_REF" => "",
    "MANUFACTURER" => "",
    "DETAIL_PICTURE" => "",




), false);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>