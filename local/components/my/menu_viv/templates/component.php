<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
define('IBLOCK_PRODUCTS', 4);
array_map('CModule::IncludeModule', ['iblock', 'catalog', 'sale']);


echo '<pre>';
print_r($_GET["find_section_section"]);
echo '</pre>';
if (!empty($_GET["find_section_section"]))
{
    $rsSection = CIBlockSection::GetList(
        array(),
        array(

            'IBLOCK_ID' => IBLOCK_PRODUCTS,
            'SECTION_ID' => $_GET["find_section_section"]

        ),

        [
            'ID', 'IBLOCK_ID', 'NAME', 'IBLOCK_SECTION_ID'
        ],
        false

    );

    while ($section = $rsSection->fetch())
    {
        $arSections[] = $section;
    }
    print_r($arSections);


}



/*
if (!empty($_GET[""]))
{
    $rsElement = CIBlockElement::GetList(
        array(),
        array(

            'IBLOCK_ID' => $_GET["IBLOCK_ID"],
            'SECTION_ID' => $_GET["find_section_section"],
            'ID' => $_GET["ELEMENT_ID"],
        ),
        false,
        false,
        [
            'ID', 'IBLOCK_ID','IBLOCK_SECTION_ID', 'NAME', 'DETAIL_PICTURE',
            'PROPERTY_ARTNUMBER',
            'PROPERTY_MANUFACTURER',
            'PROPERTY_DESCRIPTION',
            'PROPERTY_BRAND_REF',
            'PROPERTY_PRICE',
            'PROPERTY_CHARACTERISTICS',
            'PROPERTY_*'


        ]
    );

    $price = [];
    $arProduct = GetCatalogProduct(8032);

    $price = CPrice::GetList(
        array(),
        array(
            "PRODUCT_ID" => $_GET["ELEMENT_ID"]
        ),
        false,
        false,
        array("*")
    );
    if ($ar_res = $price->Fetch())
    {
        //echo CCurrencyLang::CurrencyFormat($ar_res["PRICE"], $ar_res["CURRENCY"]);
    }
    else
    {
        //echo "Цена не найдена!";
    }
    echo '<pre>';
    //print_r($price);
    echo '</pre>';
    $ID=(int)$_GET["ELEMENT_ID"];
    $ar_result = CCatalogProduct::GetByID($ID);
    //print_r($ar_result);
    while($arElement = $rsElement->GetNext())
    {
        echo '<pre>';
        //print_r($arElement);
        echo '</pre>';
        $brand_result = $brandDataClass::getList(array(
            "select" => array(
                'ID',
                'UF_NAME',
                'UF_XML_ID'
            ),
            "order" => array(),
            "filter" => array(
                'UF_XML_ID' => $arElement["PROPERTY_BRAND_REF_VALUE"]
            )
        ));
        $array_brend = $brand_result->Fetch()['UF_NAME'];
        //print_r(CFile::GetFileArray($arElement["DETAIL_PICTURE"]));
        //print_r(CFile::GetPath($arElement["DETAIL_PICTURE"]));
        // $rCIBlockElement::GetList(array(),array("DESCRIPTION"=>$arElement["DESCRIPTION"]));
        //$arviv = $r->GetNext();
        //print_r($arviv);
        //print_r($arElement["PROPERTY_BRAND_REF_VALUE"]);
        $arProduct['NAME'] = $arElement["NAME"];
        $arProduct['DESCRIPTION']=$arElement["PROPERTY_DESCRIPTION_VALUE"];
        $arProduct['ARTNUMBER']=$arElement["PROPERTY_ARTNUMBER_VALUE"];
        $arProduct['MANUFACTURER']=$arElement["PROPERTY_MANUFACTURER_VALUE"];
        $arProduct['DETAIL_PICTURE'] = CFile::GetPath($arElement["DETAIL_PICTURE"]);
        $arProduct['BRAND'] = $array_brend;
        $arProduct['IBLOCK_ID']= $arElement['IBLOCK_ID'];
        $arProduct['IBLOCK_SECTION_ID']= $arElement['IBLOCK_SECTION_ID'];
        $arProduct['CHARACTERISTICS']= $arElement['PROPERTY_CHARACTERISTICS_VALUE'];
        $arProduct['QUANTITY']= $ar_result["QUANTITY"];
        $arProduct['PRICE']= $arElement['PROPERTY_PRICE_VALUE'];
        $arProduct['ID']= $arElement['ID'];
        //print_r($arProduct['CHARACTERISTICS']);


        $arResult[] = $arProduct;

    }

}
else {
    echo "Переменные не дошли. Проверьте все еще раз.";
}
echo '<pre>';
//print_r($arResult);
echo '</pre>';
*/
$this->IncludeComponentTemplate();
?>
