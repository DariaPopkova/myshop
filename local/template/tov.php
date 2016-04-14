<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

ini_set("display_errors",1);
error_reporting(E_ALL  & ~E_NOTICE & ~E_STRICT);

define('HLIBLOCK_BRANDS', 3);
define('IBLOCK_PRODUCTS', 4);

array_map('CModule::IncludeModule', ['iblock', 'highloadblock']);

$brandDataClass = HL\HighloadBlockTable::compileEntity(
    HL\HighloadBlockTable::getById(HLIBLOCK_BRANDS)
        ->fetch()
)->getDataClass();


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
/*$properties = CIBlockProperty::GetList(Array() , Array("IBLOCK_ID"=>IBLOCK_PRODUCTS,"CODE"=>"MANUFACTURER"));
if($prop_fields = $properties->GetNext())
{
    echo $prop_fields["ID"]."<br>";
}*/


$first = true;
$header = [];
$idmanuf = [];
$man = [];
$valu = [];
$properties = CIBlockProperty::GetList(
    Array(),
    Array(
        "IBLOCK_ID" => IBLOCK_PRODUCTS,
        "CODE" => "MANUFACTURER"
    )
);
$prop_fields = $properties->GetNext();

echo '<pre>';
$property_enums = CIBlockPropertyEnum::GetList(
    array(),
    array(
        "IBLOCK_ID" => IBLOCK_PRODUCTS,
        "CODE" => "MANUFACTURER"
    )
);
while($get_list = $property_enums->GetNext())
{
    $valu[$get_list["ID"]] = $get_list["VALUE"];
}


$handle = fopen("tovari.txt", "r");

while (!feof($handle)) {

    echo '====================================================='.PHP_EOL;
    $line = fgets($handle);

    if ($first == true) {
        $header = explode(",", $line);
        $first = false;
    } else {
        $tov = [];
        $pieces = explode(",", $line);

        foreach ($pieces as $i => $value) {
            $tov[trim($header[$i])] = trim($value);
        }
        $tov['DETAIL_PICTURE'] = $_SERVER["DOCUMENT_ROOT"] . "/local/template/img/" . $tov['DETAIL_PICTURE'];
        if (!file_exists($tov['DETAIL_PICTURE'])) {
            echo "Файл " . $tov['DETAIL_PICTURE'] . " не существует<br>";
            continue;
        }
        $brandResult = (new Entity\Query($brandDataClass))
            ->setSelect(
                ['ID', 'UF_NAME', 'UF_XML_ID']
            )
            ->setFilter(
                [
                    'UF_NAME' => $tov['BRAND_REF']
                ]
            )
            ->exec()
            ->fetch();
        if (!empty($brandResult)) {
            $tov['BRAND_REF'] = $brandResult['UF_XML_ID'];
        } else {
            $tov['BRAND_REF'] = $brandDataClass::add(array( //добавляем элемент
                'UF_NAME' => $tov['BRAND_REF']
            ))->getId();
        }
        $manuf = new CIBlockPropertyEnum;

        //$get_list = $property_enums->GetNext();
        $key = array_search($tov['MANUFACTURER'], $valu);
        echo $key.PHP_EOL;

        if($key === false)
        {
            echo 'Добавляем! '.$tov['MANUFACTURER'].PHP_EOL;

            if ($resu = $manuf->Add(
                Array(
                    'PROPERTY_ID' => $prop_fields['ID'],
                    'PROPERTY_CODE' => 'MANUFACTURER',
                    'VALUE' => $tov['MANUFACTURER']
                )
            )
            ) {
                $tov['MANUFACTURER_ID'] = $resu;
                $valu[$tov['MANUFACTURER_ID']] = $tov['MANUFACTURER'];
            }

        }
        else
        {
            echo 'Получилось! '.$tov['MANUFACTURER'].PHP_EOL;
            $tov['MANUFACTURER_ID'] = $key;
        }
                /*
               $dbManufacturer = $manuf::GetList(
                    array(),
                    array(
                        //"VALUE" => $tov['MANUFACTURER'],
                        "IBLOCK_ID" => IBLOCK_PRODUCTS
                    )
                );
                if ($manufacturer = $dbManufacturer->Fetch()) {
                    $tov['MANUFACTURER_ID'] = $manufacturer['ID'];
                } else {
                    $properties = CIBlockProperty::GetList(
                        Array(),
                        Array(
                            "IBLOCK_ID" => IBLOCK_PRODUCTS,
                            "CODE" => "MANUFACTURER"
                        )
                    );
                    $prop_fields = $properties->GetNext();

                    if ($resu = $manuf->Add(
                        Array(
                            'PROPERTY_ID' => $prop_fields['ID'],
                            'PROPERTY_CODE' => 'MANUFACTURER',
                            'VALUE' => $tov['MANUFACTURER']
                        )
                    )
                    ) {
                        $tov['MANUFACTURER_ID'] = $resu;
                    }
                }
*/

        $el = new CIBlockElement;
        $arFields = Array(
            "NAME" => $tov['NAME'],
            "IBLOCK_SECTION_ID" => $tov['IBLOCK_SECTION_ID'],
            "IBLOCK_ID" => IBLOCK_PRODUCTS,
            "DETAIL_PICTURE" => CFile::MakeFileArray($tov['DETAIL_PICTURE']), //TODO
            "ACTIVE" => 'Y',
            "PROPERTY_VALUES" => [
                "ARTNUMBER" => $tov['ARTNUMBER'],
                "DESCRIPTION" => $tov['DESCRIPTION'],
                "BRAND_REF" => $tov['BRAND_REF'],
                "MANUFACTURER" => $tov['MANUFACTURER_ID'],
            ],

        );
        if ($id = $el->Add($arFields)) {
            echo "Успешно".PHP_EOL;
        } else {
            echo "Error: " . $el->LAST_ERROR.PHP_EOL;
        }
        echo '====================================================='.PHP_EOL;

    }





}

fclose($handle);
echo '</pre>';


