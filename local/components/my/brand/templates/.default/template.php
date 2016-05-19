<?/*
echo '<pre>';
print_r($arResult);
echo '</pre>';*/
?>
<aside>
    <?foreach($arResult as $brand):?>
    <a href="http://popkova.bitrix.develop.maximaster.ru/catalog.php?IBLOCK_ID=4&find_section_section=<?=$_GET['find_section_section'];?>&brand_id=<?=$brand['ID'];?>">
        <?echo '<div class="brand">';?>

       <? echo $brand['UF_NAME'];

        echo '</div>';?>
       </a>
    <?endforeach;?>
    <div id="poisk">
        <form>
            <input type="search" class="srch" placeholder="Поиск по сайту">
            <input type="submit" class="srch" value="Найти">
        </form>
    </div>

    <div id="socseti">
        <h5>МЫ В СОЦСЕТЯХ</h5>
        <div id="seti">
            <ul id="vibseti">
                <li>
                    <a target="_blank" class="soc" href="/"> hjfhtr</a>
                </li>
                <li>
                    <a target="_blank" class="soc" href="/"> hjfhtr</a>
                </li>
                <li>
                    <a target="_blank" class="soc" href="/"> hjfhtr</a>
                </li>
                <li>
                    <a target="_blank" class="soc" href="/"> hjfhtr</a>
                </li>
                <li>
                    <a target="_blank" class="soc" href="/"> hjfhtr</a>
                </li>
            </ul>
        </div>

    </div>
    <div id="podpiska">
        <h6>РАССЫЛКА</h6>
        <form id="rassilka">
            <div>
                <input type="email" placeholder="Введите ваш e-mail">
            </div>
            <div>
                <button id="podkn">Подписаться</button>
            </div>

        </form>

    </div>

    <div id="info">
        <h6>ПОЛЕЗНАЯ ИНФОРМАЦИЯ</h6>
        <a target="_blank" class="info-box" href="/">
            <div id="img1"></div>

            <h6>О МАГАЗИНЕ</h6>
            <div class="info-content">
                Узнайте больше о нашем магазине,о наших контактах и реквизитах.
            </div>

        </a>

    </div>
</aside>