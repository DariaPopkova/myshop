<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
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
?>