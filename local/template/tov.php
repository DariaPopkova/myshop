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
            $product['BRAND_REF_ID'] = $brandDataClass::add(array(
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
        $manufacture = new CIBlockPropertyEnum;
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
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>IBLOCK_PRODUCTS, "ID"=>  7422);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
$ob = $res->GetNextElement();
$arFields = $ob->GetFields();



