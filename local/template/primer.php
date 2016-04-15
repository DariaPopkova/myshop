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
$array_manufacture = [];
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
    $array_manufacture[$get_list["ID"]] = $get_list["VALUE"];
}
$brand_result = $brandDataClass::getList(array(
    "select" => array(
        'ID',
        'UF_NAME',
        'UF_XML_ID'
    ),
    "order" => array(),
    "filter" => array()
));
$massiv_brend = [];
$xml_brand = [];
while($array_brend = $brand_result->Fetch())
{
    $massiv_brend[$array_brend['UF_XML_ID']] = $array_brend['UF_NAME'];
    //$xml_brand[$array_brend['UF_XML_ID']] = $array_brend['ID'];

}
print_r($array_brend);
$handle = fopen("tovari.txt", "r");
while (!feof($handle)) {

    echo '====================================================='.PHP_EOL;
    $line = fgets($handle);

    if ($first == true) {
        $header = explode(",", $line);
        $first = false;
    } else {
        $product = [];
        $pieces = explode(",", $line);

        foreach ($pieces as $i => $value) {
            $product[trim($header[$i])] = trim($value);
        }
        $product['DETAIL_PICTURE'] = $_SERVER["DOCUMENT_ROOT"] . "/local/template/img/" . $product['DETAIL_PICTURE'];
        if (!file_exists($product['DETAIL_PICTURE'])) {
            echo "Файл " . $product['DETAIL_PICTURE'] . " не существует<br>";
            continue;
        }

        $key_brand = array_search($product['BRAND_REF'], $massiv_brend);

        echo $key_brand.PHP_EOL;

        if($key_brand === false)
        {
            echo 'Добавляем! '.$product['BRAND_REF'].PHP_EOL;
            $product['BRAND_REF_ID'] = $brandDataClass::add(array( //добавляем элемент
                'UF_NAME' => $product['BRAND_REF']
            ))->getId();



            $brandResult = (new Entity\Query($brandDataClass))
                ->setSelect(
                    ['ID', 'UF_NAME', 'UF_XML_ID']
                )
                ->setFilter(
                    [
                        'ID' => $product['BRAND_REF_ID']
                    ]
                )
                ->exec()
                ->fetch();
            if (!empty($brandResult)) {
                $product['BRAND_REF_XID'] = $brandResult['UF_XML_ID'];
            }
            $massiv_brend[$product['BRAND_REF_XID']] = $product['BRAND_REF'];
            print_r($massiv_brend);




        }
        else
        {
            $product['BRAND_REF_XID'] = $key_brand;
            echo 'Получилось! '.$product['BRAND_REF'].PHP_EOL;

            print_r($product['BRAND_REF_XID']);
        }

        /*
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
            print_r($tov['BRAND_REF']);
        }*/
        $manufacture = new CIBlockPropertyEnum;

        //$get_list = $property_enums->GetNext();
        $key = array_search($product['MANUFACTURER'], $array_manufacture);
        echo $key.PHP_EOL;

        if($key === false)
        {
            echo 'Добавляем! '.$product['MANUFACTURER'].PHP_EOL;




            if ($result_man = $manufacture->Add(
                Array(
                    'PROPERTY_ID' => $prop_fields['ID'],
                    'PROPERTY_CODE' => 'MANUFACTURER',
                    'VALUE' => $product['MANUFACTURER']
                )
            )
            ) {
                $product['MANUFACTURER_ID'] = $result_man;
                $array_manufacture[$product['MANUFACTURER_ID']] = $product['MANUFACTURER'];
            }

        }
        else
        {
            echo 'Получилось! '.$product['MANUFACTURER'].PHP_EOL;
            $product['MANUFACTURER_ID'] = $key;
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
            "NAME" => $product['NAME'],
            "IBLOCK_SECTION_ID" => $product['IBLOCK_SECTION_ID'],
            "IBLOCK_ID" => IBLOCK_PRODUCTS,
            "DETAIL_PICTURE" => CFile::MakeFileArray($product['DETAIL_PICTURE']), //TODO
            "ACTIVE" => 'Y',
            "PROPERTY_VALUES" => [
                "ARTNUMBER" => $product['ARTNUMBER'],
                "DESCRIPTION" => $product['DESCRIPTION'],
                "BRAND_REF" => $product['BRAND_REF_XID'],
                "MANUFACTURER" => $product['MANUFACTURER_ID'],
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


