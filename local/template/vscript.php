<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");

//добавления элемента
$el = new CIBlockElement;


$arFields = Array(
    "IBLOCK_SECTION" => 27,
    "IBLOCK_ID" => 4,


    "NAME" => Папочка,
    "PREVIEW_TEXT" => рплшаьмдлу,
    "PREVIEW_TEXT_TYPE" => text,
    "DETAIL_TEXT" => оьлоьлдоьлщлнщ,
    "DETAIL_TEXT_TYPE" => text,
    "IN_SECTIONS" => Y,
    "IBLOCK_TYPE_ID" => catalog,
    "IBLOCK_NAME" => Канцтовары,

);

$id = $el->Add($arFields);
$tov = $el->Delete(338);

///////

/*

$product = $el->GetList([], ['ID' => $id])->GetNextElement(true, false);

echo '<pre>';
if ($product)
{
    print_r($product->GetFields());
    print_r($product->GetProperties());
}
echo '</pre>';
*/



