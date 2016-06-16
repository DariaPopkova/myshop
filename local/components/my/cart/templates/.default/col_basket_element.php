<?include_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
array_map('CModule::IncludeModule', ['iblock', 'catalog', 'sale']);
$elementID = $_GET['ID'];
$rsBaskets = CSaleBasket::GetList(
    array("ID" => "ASC"),
    array(
        "FUSER_ID" => $fuserId,
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL",
        "PRODUCT_ID" => $elementID
    ),
    false,
    false,
    array(
        "ID", "NAME", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY",
        "PRICE", "WEIGHT", "DETAIL_PAGE_URL", "NOTES", "CURRENCY", "VAT_RATE", "CATALOG_XML_ID",
        "PRODUCT_XML_ID", "SUBSCRIBE", "DISCOUNT_PRICE", "PRODUCT_PROVIDER_CLASS", "TYPE", "SET_PARENT_ID"
    )
);
$arItem = $rsBaskets->GetNext();
echo '<div class="basket_kol">';
echo $arItems['QUANTITY'];
echo '</div>';
?>