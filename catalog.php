<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->IncludeComponent(
    "my:catalog",
    ".default",
    array(),
    false
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>