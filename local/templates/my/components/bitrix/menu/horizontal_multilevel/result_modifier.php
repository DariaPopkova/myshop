<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
array_map('CModule::IncludeModule', ['iblock','catalog']);
$cp = $this->__component; // объект компонента
$sectionID = $_GET['SECTION_ID'];
$search_section =  CIBlockSection::GetList(
    array(),
    array(
        'ID' => $sectionID
    )

)->Fetch();

if ((is_object($cp))&&(isset($search_section)))
{
    $cp->arResult['MY_TITLE'] = $search_section['NAME'];
    $cp->arResult['IS_OBJECT'] = 'Y';
    if($search_section['ID'] == 0)
    {
        $cp->arResult['MY_TITLE'] = 'Главная';
    }
    $cp->SetResultCacheKeys(array('MY_TITLE', 'IS_OBJECT'));
    $arResult['MY_TITLE'] = $cp->arResult['MY_TITLE'];
    $arResult['IS_OBJECT'] = $cp->arResult['IS_OBJECT'];
}

