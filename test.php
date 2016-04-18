<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->IncludeComponent("my:test", ".default", array(

    "NAME" => "Бумага IQ Allround",

));
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>