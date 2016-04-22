<nav>
    <?//print_r($arResult);


    ?>

    <ul id="v-menu">
    <?$name = 0;
    foreach($arResult as $section): ?>
        <?echo '<pre>';
print_r($section[key($section)]['CHILDRENS'][35]['NAME']);
echo '</pre>';?>

        <li class="menu">
            <span id="s1"></span>
            <?
                if($section[key($section)]['NAME'] !=$name){
                    echo '<a href="#" class="menus">';
                    echo $section[key($section)]['NAME'];
                    echo '</a>';
                }
            ?>
            <?
            echo '<li><a href="#">';
            echo $section[key($section)]['CHILDRENS'][key($section['CHILDRENS'])]['NAME'];
            //echo $section[key($section)]['CHILDRENS'][]['SUBSECTION'][key($section['SUBSECTION'])]['NAME'];
            echo '</a></li>';
            $name = $section['NAME']
            ?>


        </li>

    <? endforeach; ?>
    </ul>





</nav>