<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
$el = new CIBlockElement;
$handle = fopen("tovari.txt", "r");
while (!feof($handle)) {
    $line = fgets($handle);

    $pieces = explode(",", $line);
    print_r($pieces);
    $save=CFile::SaveFile("img/1.jpg", "/iblock/acf/");


    $arFields = Array(
        "IBLOCK_SECTION_ID" => $pieces[6],
        "IBLOCK_ID" => 4,

        "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/img/1.jpg"),


        "NAME" => $pieces[0],

        "IN_SECTIONS" =>  "$pieces[2]",
        "ARTNUMBER" => $pieces[3],
        "GROUP0" => $pieces[4],





    );
    $id = $el->Add($arFields);





}







fclose($handle);



