<nav>
    <?//print_r($arResult);?>
    <ul id="v-menu">
    <?foreach($arResult as $key=> $section): ?>
        <li class="menu">
            <span id="s1"></span>
            <a href="#" class="menus"><?echo $section['NAME'];?></a>
        <?foreach($section as $section=> $pod): ?>
            <ul class="ot">
            <?foreach($pod as $pod=> $znach): ?>
                <li><a href="#"><?echo $znach['NAME'];?></a></li>
            <? endforeach; ?>
            </ul>
        <? endforeach; ?>
        </li>
    <? endforeach; ?>
    </ul>
</nav>