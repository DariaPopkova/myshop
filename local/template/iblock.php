<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");

//добавления элемента
$el = new CIBlockElement;

$idb = $el->GetIBlockByID(341);
echo $idb;
