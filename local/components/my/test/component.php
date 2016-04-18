<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
echo '<pre>'; print_r($arParams); echo '</pre>';
CModule::IncludeModule('iblock');

    $name = $arParams['NAME'];

    $db_list = CIBlockElement::GetList(
        array(),
        array(
            'IBLOCK_ID' => 4,
            'IBLOCK_SECTION_ID' => 35,
            'NAME' => $name,
        ),
        false,
        false,
        array("NAME")
    );
        while($ar_result = $db_list->GetNext())
    {
       $arResult[] = array(
            "NAME" => $ar_result['NAME'],
            );

    }


 echo '<pre>'; print_r($arResult); echo '</pre>';
    $this->IncludeComponentTemplate();

?>