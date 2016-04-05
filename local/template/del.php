<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");

//добавления элемента
$el = new CIBlockElement;

$tov = $el->Delete(339);
$tov = $el->Delete(340);