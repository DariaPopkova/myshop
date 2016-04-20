<nav>
    <?$N=0;?>
    <?$n=0;?>
    <?$i=0;?>
    <? foreach($arResult as $sect): ?>
        <?if(empty($sect['IBLOCK_SECTION_ID'])):?>
            <?$col[$i]= $arResult[$i];
            //$col['NAME']= $arResult['NAME'];
            $N++;
            ?>

        <?else:?>
            <?$razdel[$i]= $arResult[$i];
            $n++;
            ?>

        <?endif;?>
        <?$i++;?>
    <? endforeach;?>
    <?
    echo '<pre>';
    print_r($arResult);
    echo '</pre>';
    ?>

    <? foreach($arResult as $section): ?>



        <ul id="v-menu">
        <li class="menu">
            <span id="s1"></span>
            <?if(empty($section['IBLOCK_SECTION_ID'])):?>
                <?for($i=0; $i<$N; $i++):?>
                    <?if($section['ID']==$col[$i]['ID']):?>
                        <a href="#" class="menus">
                            <?=$col['NAME'];?>
                        </a>
                    <?endif;?>
                <?endfor;?>
            <?else:?>
                <ul class="ot">
                    <?for($i=$N-1; $i<$n; $i++):?>
                        <?if($section['IBLOCK_SECTION_ID']==$col[$i]['ID']):?>
                            <li><a href="#"> <?=$section['NAME'];?></a></li>
                            <?endif;?>
                    <?endfor;?>



                </ul>
            <?endif;?>


        </li>
    </ul>
    <? endforeach; ?>


</nav>