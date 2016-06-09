<?include_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
//ini_set('display_errors',1);
//error_reporting(E_ALL ^E_NOTICE);
array_map('CModule::IncludeModule', ['iblock', 'catalog', 'sale']);


$elementID = $_POST['ID'];
$kolich = $_POST['kol'];
if(isset($_POST['kol']))
{
    Add2BasketByProductID(
        $elementID,
        $kolich
    );
}


//$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "template", $GLOBALS['BASKET_RESPONSE_AJAX_PARAMS'], false, array('HIDE_ICONS' => 'Y'));
$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small","saleBasket",Array(
        "PATH_TO_BASKET" => "/personal/cart/",
        "PATH_TO_ORDER" => "/cart.php",
        "SHOW_DELAY" => "N",
        "SHOW_NOTAVAIL" => "N",
        "SHOW_SUBSCRIBE" => "N",
        "KOLICH" => $_POST['kol'],
    )
);
print_r($kolich);
?>