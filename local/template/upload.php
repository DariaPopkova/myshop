<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
$el = new CIBlockElement;

$PROP = array();
$PROP[COLOR] = "Белый";


$arLoadProductArray = Array(

    "IBLOCK_SECTION" => 27,
    "IBLOCK_ID" => 4,
    "PROPERTY_VALUES"=> $PROP,
    "NAME" => Папочка,
    "ACTIVE"         => "Y",            // активен
    "PREVIEW_TEXT" => рплшаьмдлу,
    "DETAIL_TEXT" => оьлоьлдоьлщлнщ,

);

$PRODUCT_ID = 341;  // изменяем элемент с кодом (ID) 2
$res = $el->Update($PRODUCT_ID, $arLoadProductArray);