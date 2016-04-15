<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->IncludeComponent("my:test", ".default", array(
    "IBLOCK_ID" => 4
));
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>