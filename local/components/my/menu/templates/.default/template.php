<nav>
    <?//print_r($arResult);


    ?>

    <ul id="v-menu">
    <?foreach($arResult as $section): ?>

        <li class="menu">
            <span id="s1"></span>
            <?
                if($section['NAME'] !=$name){
                    echo '<a href="#" class="menus">';
                    //echo $section['NAME'];
                    echo '</a>';
                }
            ?>
            <?
            echo '<li><a href="#">';
            echo $section['SUBSECTION'][key($section['SUBSECTION'])]['NAME'];
            echo '</a></li>';

            ?>


        </li>

    <? endforeach; ?>
    </ul>





</nav>