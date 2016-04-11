<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
//CModule::IncludeModule("iblock");
//CModule::IncludeModule('highloadblock'); //модуль highload инфоблоков
array_map('CModule::IncludeModule', ['iblock', 'highloadblock']);
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
$hlblock_requests=HL\HighloadBlockTable::getById(3)->fetch();//requests
$entity_requests=HL\HighloadBlockTable::compileEntity($hlblock_requests);
$entity_requests_data_class = $entity_requests->getDataClass();
$main_query_requests = new Entity\Query($entity_requests_data_class);
$main_query_requests->setSelect(array('ID','UF_NAME'));
$main_query_requests->setFilter(
    array(
        'UF_NAME'=>'Радуга',
    )
);
$result_requests = $main_query_requests->exec();
$result_requests = new CDBResult($result_requests);
while ($row_requests=$result_requests->Fetch()) {
    $requests[] = $row_requests; //массив выбранных элементов
}
//print_r($requests[0][UF_NAME]);
/*
$result = $entity_requests_data_class::add(array( //добавляем элемент
    'UF_NAME'=>'Rhfcbds',
    'UF_DESCRIPTION'=>'Бла-бла',
));
*/
/*if ( !($arData = $hlblock->fetch()) ){
    echo 'Инфоблок не найден';
}
else{
    echo 'Инфоблок найден';
}*/
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
        "IBLOCK_SECTION_ID" => $pieces[7],
        "IBLOCK_ID" => 4,
        "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/local/template/img/".$pieces[5]),
        "NAME" => $pieces[0],
        "ACTIVE" =>  "$pieces[2]",
        "PROPERTY_VALUES"=> [
            "ARTNUMBER" => $pieces[4],
            "DESCRIPTION" => $pieces[3],
            "BRAND_REF" => 	$pieces[6],
        ],
    );
    $id = $el->Add($arFields);
}
fclose($handle);
