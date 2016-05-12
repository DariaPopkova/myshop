<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
ini_set("display_errors",1);
error_reporting(E_ALL  & ~E_NOTICE & ~E_STRICT);
define('HLIBLOCK_BRANDS', 7);
//define('IBLOCK_PRODUCTS', 4);
array_map('CModule::IncludeModule', ['iblock', 'highloadblock', 'catalog', 'sale']);
$brandDataClass = HL\HighloadBlockTable::compileEntity(
    HL\HighloadBlockTable::getById(HLIBLOCK_BRANDS)
        ->fetch()
)->getDataClass();
//$hlblock = HL\HighloadBlockTable::getById(HLIBLOCK_BRANDS)->fetch();
//$entity = HL\HighloadBlockTable::compileEntity($hlblock);
//var_dump($entity ->getFields());
$brand_result = $brandDataClass::getList(array(
    "select" => array(
        '*'
    ),
    "order" => array(),
    "filter" => array()
));
$massiv_brend = [];
$xml_brand = [];
while($array_brend = $brand_result->Fetch())
{
    //print_r($array_brend);
    $massiv_brend[$array_brend['UF_XML_ID']] = $array_brend['UF_NAME'];
}
$key_brand = array_search("Зараза не добавляющаяся", $massiv_brend);
echo $key_brand.PHP_EOL;
if($key_brand === false)
{
    echo 'Добавляем! '."Зараза не добавляющаяся".PHP_EOL;
    $product['BRAND_REF_ID'] = $brandDataClass::add(array(
        'UF_NAME' => "Зараза не добавляющаяся",
        'UF_XML_ID' =>  md5(uniqid(""))
    ))->getId();
    /* $result = $brandDataClass::update( //обновляем значения элемента
         $product['BRAND_REF_ID'],	//id элемента
         array(
             'UF_NAME' => "КитайкаКитаянская",
         )
     );*/
    //print_r($product['BRAND_REF']);

    $brandResult = (new Entity\Query($brandDataClass))
        ->setSelect(
            ['ID', 'UF_NAME', 'UF_XML_ID']
        )
        ->setFilter(
            [
                'UF_NAME' => "Зараза не добавляющаяся"
            ]
        )
        ->exec()
        ->fetch();
    print_r($brandResult);
    if (!empty($brandResult)) {
        $product['BRAND_REF_XID'] = $brandResult['UF_XML_ID'];
        //echo $product['BRAND_REF_XID'];
    }
    $massiv_brend[$product['BRAND_REF_XID']] = $product['BRAND_REF'];
    //print_r($massiv_brend);
}
else
{
    $product['BRAND_REF_XID'] = $key_brand;
    echo 'Получилось! '.$product['BRAND_REF'].PHP_EOL;
    //print_r($product['BRAND_REF_XID']);
}




