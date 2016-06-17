<?include_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
//ini_set('display_errors',1);
//error_reporting(E_ALL ^E_NOTICE);
array_map('CModule::IncludeModule', ['iblock', 'catalog', 'sale']);

$elementID = $_POST['ID'];
$kolich = $_POST['kol'];
$fuserId = (int)CSaleBasket::GetBasketUserID(true);
if(isset($_POST['kol']))
{
    if ($fuserId > 0)
    {
        $db_res = CCatalogProduct::GetList(
            array(),
            array(
                "ID" => $elementID
            ),
            false,
            array()
        );
        $ar_res = $db_res->Fetch();
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
        if ($arItem['QUANTITY']+ $kolich <= $ar_res['QUANTITY'])
        {
            echo '<div id="basket_kol">';
            echo $arItem['QUANTITY']+ $kolich;
            echo '</div>';
            Add2BasketByProductID(
                $elementID,
                $kolich
            );
        }
    }

}
$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small","saleBasket",Array(
        "PATH_TO_BASKET" => "/personal/cart/",
        "PATH_TO_ORDER" => "/cart.php",
        "SHOW_DELAY" => "N",
        "SHOW_NOTAVAIL" => "N",
        "SHOW_SUBSCRIBE" => "N",

    )
);

?>


