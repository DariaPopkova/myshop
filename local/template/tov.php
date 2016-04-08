<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


//CModule::IncludeModule("iblock");
//CModule::IncludeModule('highloadblock'); //модуль highload инфоблоков
array_map('CModule::IncludeModule', ['iblock', 'highloadblock']);
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

/*$hlblock_requests=HL\HighloadBlockTable::getById(3)->fetch();//requests
$entity_requests=HL\HighloadBlockTable::compileEntity($hlblock_requests);
$entity_requests_data_class = $entity_requests->getDataClass();
$main_query_requests = new Entity\Query($entity_requests_data_class);
$main_query_requests->setSelect(array('ID','UF_NAME', 'UF_XML_ID'));
$main_query_requests->setFilter(
    array(
        'UF_NAME'=>'Радуга',
    )
);
$result_requests = $main_query_requests->exec();
$result_requests = new CDBResult($result_requests);

while ($row_requests=$result_requests->Fetch()) {
    $requests[] = $row_requests; //массив выбранных элементов
}*/

/*for($i = 5; $i <= 8; $i++)
{
    $result = $entity_requests_data_class::delete($i);	//удаляем элемент
}*/

//print_r($requests[0][UF_XML_ID]);

/*
$result = $entity_requests_data_class::add(array( //добавляем элемент
    'UF_NAME'=>'Rhfcbds',
    'UF_DESCRIPTION'=>'Бла-бла',
));
*/


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
$i=0;
while (!feof($handle)) {
    $line = fgets($handle);






    if($i=0){
        $pieces = explode(",", $line);
        $s=array(
            "0"=>"Name",
            "1"=>"ACTIVE",
            "2"=>"DESCRIPTION",
            "3"=>"ARTNUMBER",
            "4"=>"DETAIL_PICTURE",
            "5"=>"BRAND_REF",
            "6"=>"MANUFACTURER",
            "7"=>"IBLOCK_SECTION_ID");
        while ($pieces = current($s)) {

        }


        continue;
    }
    $pieces = explode(",", $line);
    print_r($pieces);

    echo $_SERVER["DOCUMENT_ROOT"]."/local/template/img/".$pieces['DETAIL_PICTURE']."";


    if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/template/img/".$pieces['DETAIL_PICTURE'])) {
        echo "Файл существует";
    } else {
        echo "Файл не существует";
        continue;

    }
    $hlblock_requests=HL\HighloadBlockTable::getById(3)->fetch();//requests
    $entity_requests=HL\HighloadBlockTable::compileEntity($hlblock_requests);
    $entity_requests_data_class = $entity_requests->getDataClass();
    $main_query_requests = new Entity\Query($entity_requests_data_class);
    $main_query_requests->setSelect(array('ID','UF_NAME','UF_XML_ID'));
    $main_query_requests->setFilter(
        array(
            'UF_NAME'=>$pieces['BRAND_REF'],
        )
    );
    $result_requests = $main_query_requests->exec();
    $result_requests = new CDBResult($result_requests);

    while ($row_requests=$result_requests->Fetch()) {
        $requests[] = $row_requests; //массив выбранных элементов
    }
    //print_r($requests[0][UF_XML_ID]);
    $f=$requests[0][UF_NAME];
    $h=$pieces[5];
    print_r($f);

    if(strcmp($f,$h))
    {
        $vr= $requests[0][UF_XML_ID];
        print_r($vr);

    }
    else
    {
        echo "Это не хорошо";
        continue;
    }

    $infoblock = 4; // Инфоблок с id 13
    $rs_Section = CIBlockSection::GetList(array("MANUFACTURER" => $pieces['MANUFACTURER']), array("IBLOCK_ID" => $infoblock));
    while ( $ar_Section = $rs_Section->Fetch() )
    {
        $ar_Resu[] = $ar_Section;

    }

    if(strcmp($ar_Resu[0],$pieces['MANUFACTURER']))
    {
        $res = CIBlockProperty::GetList(
            array (),
            array (
                "NAME" => $pieces[6],
            )
        )->GetNext()["ID"];

        print_r($res);
    }
    else{
        echo "Это не хорошо";
        continue;
    }






    $arFields = Array(
        "IBLOCK_SECTION_ID" => $pieces['IBLOCK_SECTION_ID'],
        "IBLOCK_ID" => 4,



        "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/local/template/img/".$pieces['DETAIL_PICTURE']),


        "NAME" => $pieces['NAME'],

        "ACTIVE" =>  $pieces['ACTIVE'],
        "PROPERTY_VALUES"=> [
            "ARTNUMBER" => $pieces['ARTNUMBER'],
            "DESCRIPTION" => $pieces['DESCRIPTION'],
            "BRAND_REF" => $requests[0][UF_XML_ID],
            "MANUFACTURER" => $res,

        ],







    );
    $id = $el->Add($arFields);






}







fclose($handle);



