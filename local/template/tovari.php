<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
array_map('CModule::IncludeModule', ['iblock', 'highloadblock']);
$el = new CIBlockElement;
$handle = fopen("tovari_1.txt", "r");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
$handle = fopen("tovari_1.txt", "r");
$hlblock_requests=HL\HighloadBlockTable::getById(3)->fetch();//requests
$entity_requests=HL\HighloadBlockTable::compileEntity($hlblock_requests);
$entity_requests_data_class = $entity_requests->getDataClass();
$main_query_requests = new Entity\Query($entity_requests_data_class);

$first = true;
$header = [];
while (!feof($handle)) {
    $line = fgets($handle);
    $pieces = explode(",", $line);
    print_r($pieces);
    $save=CFile::SaveFile("img/1.jpg", "/iblock/acf/");
    $arFields = Array(
        "IBLOCK_SECTION_ID" => $pieces[6],
        "IBLOCK_ID" => 4,
        "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/img/1.jpg"),
        "NAME" => $pieces[0],
        "IN_SECTIONS" =>  "$pieces[2]",
        "ARTNUMBER" => $pieces[3],
        "GROUP0" => $pieces[4],
    );
    $id = $el->Add($arFields);
}
fclose($handle);
