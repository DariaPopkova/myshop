<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
 //echo '<pre>'; print_r($arParams); echo '</pre>';
CModule::IncludeModule('iblock');

    $iblock_id = $arParams['IBLOCK_ID'];
    $arFilter = array('IBLOCK_ID'=>$iblock_id);
    $db_list = CIBlockSection::GetList(array(), $arFilter, true, array("ID", "NAME", "CODE"));
    while($ar_result = $db_list->GetNext())
    {
        $arResult[] = array(
            "ID" => $ar_result['ID'],
            "CODE" => $ar_result['CODE'],
            "NAME" => $ar_result['NAME'],

        );
    }
   // echo '<pre>'; print_r($arResult); echo '</pre>';
    $this->IncludeComponentTemplate();

?>