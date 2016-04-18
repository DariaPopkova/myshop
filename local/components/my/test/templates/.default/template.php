<div class="tov">

    <? foreach($arResult as $category): ?>
        <div class="tov">

            <div><?=$category['NAME']?></div>
            <div><?=$category['ARTNUMBER']?></div>
            <div><?=$category['DESCRIPTION']?></div>
            <div><?=$category['BRAND_REF']?></div>
            <div><?=$category['MANUFACTURER']?></div>
            <div><?=$category['DETAIL_PICTURE']?></div>
           </div>
    <? endforeach; ?>
</div>
