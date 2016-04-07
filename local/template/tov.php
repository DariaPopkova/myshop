<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule("iblock");
//сначала выбрать информацию о ней из базы данных
/*$hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();

//затем инициализировать класс сущности
$hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);

$hlDataClass = $hldata['NAME'].'Table';
$hlDataClass::getList();
if (CModule::IncludeModule('highloadblock')) {S
    $rsData = $strEntityDataClass::getList(array(
        'select' => array('ID','UF_NAME','UF_MESSAGE','UF_DATETIME'),
        'order' => array('ID' => 'ASC'),
        'limit' => '50',
    ));
    while ($arItem = $rsData->Fetch()) {
        $arItems[] = $arItem;
    }
}*/

$el = new CIBlockElement;
$handle = fopen("tovari.txt", "r");

while (!feof($handle)) {
    $line = fgets($handle);

    $pieces = explode(",", $line);

    $pieces2 = explode(",", $line);

    print_r($pieces);
echo $_SERVER["DOCUMENT_ROOT"]."/local/template/img/".$pieces[5]."";


    if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/template/img/".$pieces[5])) {
        echo "Файл существует";
    } else {
        echo "Файл не существует";
        continue;

    }


    $arFields = Array(
        "IBLOCK_SECTION_ID" => $pieces[6],
        "IBLOCK_ID" => 4,



        "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/local/template/img/".$pieces[5]),


        "NAME" => $pieces[0],

        "ACTIVE" =>  "$pieces[2]",
        "PROPERTY_VALUES"=> [
            "ARTNUMBER" => $pieces[4],
            "DESCRIPTION" => $pieces[3],


        ],






    );
    $id = $el->Add($arFields);



}







fclose($handle);



