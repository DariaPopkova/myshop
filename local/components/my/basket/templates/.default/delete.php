<?
array_map('CModule::IncludeModule', ['iblock','catalog','sale']);
$ID_zapis = $_POST['id'];
CSaleBasket::Delete($ID_zapis);
?>