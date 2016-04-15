<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->IncludeComponent("my:test", ".default", array(
    "IBLOCK_ID" => 4
),
    false);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>