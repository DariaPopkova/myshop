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
	"CACHE_TIME" => "36000000"
),
	false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
/*
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult)):
	echo '<nav>';
		echo '<ul class="left-menu">';
			foreach($arResult as $arItem):
				if($arItem["SELECTED"]):
					echo '<li><a href="<?=$arItem["LINK"]?>" class="selected">';
							echo $arItem["TEXT"];
					echo '</a></li>';
				else:
					echo '<li><a href="<?=$arItem["LINK"]?>">';
							echo $arItem["TEXT"];
							echo '</a></li>';
				endif;
			endforeach;
		echo '</ul>';
	echo '</nav>';
endif;
echo '<nav>
    <ul id="v-menu">
    	<li class="menu">
		<span id="s1"></span>
		<a href="http://popkova.bitrix.develop.maximaster.ru/catalog.php?SECTION_ID=<?=$section['ID']?>" class="menus"><?echo $section['NAME'];?></a>
		<ul class="ot">
			<li><a href="http://popkova.bitrix.develop.maximaster.ru/catalog.php?SECTION_ID=<?=$val['ID'];?>"><?=$val['NAME'];?></a></li>
		</ul>
	</li>
	</ul>
</nav>';
*/
?>