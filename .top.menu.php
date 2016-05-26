<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
CModule::IncludeModule("iblock");
$IBlock = CIBlock::GetList(
	Array(),
	Array(
		'ID' => IBLOCK_PRODUCTS
	), true
)->Fetch();

$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IS_SEF" => "N",
	"SEF_BASE_URL" => "",
	"ID" =>"SECTION_ID",
	"SECTION_URL" => "/catalog.php?SECTION_ID=#SECTION_ID#",

	"IBLOCK_TYPE" => $IBlock['TYPE'],
	"IBLOCK_ID" => IBLOCK_PRODUCTS,
	"DEPTH_LEVEL" => "2",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",

),
	false
);


$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
for($i = 0; $i < count($aMenuLinks); $i++)
{
	if (intval($aMenuLinks[$i][3]['DEPTH_LEVEL']) == 1)
	{
		$arResult[$i]= $aMenuLinks[$i];
		$k = $i;
		$i++;
		while($aMenuLinks[$i][3]['DEPTH_LEVEL'] == 2)
		{
			$arResult[$k]["SUBSECTION"][$i] = $aMenuLinks[$i];
			$i++;
		}
		$i--;

	}

}




?>




