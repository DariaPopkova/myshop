<?

if(isset($_POST['kol']))
{


array_map('CModule::IncludeModule', ['iblock', 'catalog', 'sale']);
$sectionID = $_GET['SECTION_ID'];
$elementID = $_GET['ID'];
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
$option = isset($_GET['option']) ? (int)$_GET['option'] : 1;
Add2BasketByProductID(
    $elementID,
    $_POST['kol']
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