<?
ini_set('display_errors',1);
error_reporting(E_ALL ^E_NOTICE);
array_map('CModule::IncludeModule', ['iblock', 'catalog', 'sale']);


$elementID = $_POST['ID'];
$kolich = $_POST['kol'];
if(isset($_POST['kol']))
{
$property = CIBlockElement::GetList(
    array(),
    array(
        "IBLOCK_ID" => IBLOCK_PRODUCTS,
        "SECTION_ID" => $sectionID,
        "ID" => $elementID,
    )
);
$ar_propprod = $property->Fetch();

$price = CPrice::GetList(
    array(),
    array(
        "PRODUCT_ID" => $elementID,
    )
);
$ar_price = $price->Fetch();
$product = CIBlockElement::GetList(
    array(),
    array(
        "ID" => $elementID
    )
);
$ar_pro = $product->Fetch();

Add2BasketByProductID(
    $elementID,
    $kolich
);
$get_bask = CSaleBasket::GetList(
    array(),
    array(
        "PRODUCT_ID" => $elementID
    )
);
$ar_bask = $get_bask->Fetch();
}
?>