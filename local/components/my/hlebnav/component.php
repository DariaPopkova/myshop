<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

// данный параметр определяет, отображать ли последний пункт цепочки как ссылку
// по умолчанию — нет
$arParams['SHOW_LAST_LINK'] = ($arParams['SHOW_LAST_LINK'] == 'Y') ? 'Y' : 'N';

// получаем доступ к пунктам цепочки
$arResult['ITEMS'] = $APPLICATION->arAdditionalChain;

// далее можно проделать с ними любые манипуляции
// например можно установить последнему пункту флаг LAST,
// чтобы в шаблоне не выводить ссылку
if ($arParams['SHOW_LAST_LINK'] == 'N')
{
end($arResult['ITEMS']);

$arResult['ITEMS'][ key($arResult['ITEMS']) ]['LAST'] = true;

reset($arResult['ITEMS']);
}

$this->IncludeComponentTemplate();
?>