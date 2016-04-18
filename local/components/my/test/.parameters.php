<? if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule("iblock");

$dbIBlockType = CIBlockType::GetList(
    array("sort" => "asc"),
    array("ACTIVE" => "Y")
);


$arComponentParameters = array(
    /*"GROUPS" => array(
        "NAME" => array(
            "NAME" => "NAME_PRO"
        ),

    ),*/
    "PARAMETERS" => array(
        "NAME" => array(
            "NAME" => "название инфоблока",
            "TYPE" => "STRING",

        ),


        "ARTNUMBER" => array(
            "NAME" => "артикул инфоблока",
            "TYPE" => "STRING",
        ),


    )
);




/*
$arComponentParameters = array(
   'PARAMETERS' => array(
       'IBLOCK_ID' => array(
           'NAME' => 'Id инфоблока',
           'TYPE' => 'STRING',

       ),

    ),
);*/
?>