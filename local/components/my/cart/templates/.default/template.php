<? foreach ($arResult as $category): ?>

    <h2><? echo $category['NAME']; ?></h2>
    <div id="cartfon">
        <div id="pokupka">
            <div id="price_cart">
                <div class="prop_naz_cart"><h3>Цена:</h3></div>
                <div class="prop_cart">
                    <? echo $category['PRICE']. "  руб."; ?>
                </div>
            </div>
        </div>
        <p id="knop"><button id="but">Купить</button>
        <div id="imgcart"><img src="<?= $category['DETAIL_PICTURE']; ?>"></div>
        <div id="opisanie">
            <div class="prop_tov"><? echo $category['CHARACTERISTICS']; ?></div>
        </div>
        <div id="skald">
            <div class="prop_naz_sk">Доступно:</div>
            <div class="prop_tov_sk"><? echo $category['QUANTITY']; ?></div>
        </div>
        <div id="char">
            <div id="naz_cart">
                <div class="prop_naz">Цвет:</div>
                <div class="prop_naz">Артикул:</div>
                <div class="prop_naz">Производитель:</div>
                <div class="prop_naz">Бренд:</div>
            </div>
            <div class="prop_tov"><? echo $category['DESCRIPTION']; ?></div>
            <div class="prop_tov"><? echo $category['ARTNUMBER']; ?></div>
            <div class="prop_tov"><? echo $category['MANUFACTURER']; ?></div>
            <div class="prop_tov"><? echo $category['BRAND']; ?></div>
        </div>


    </div>
<? endforeach; ?>
<?

setcookie("surname",$_POST['surname'],time()+60*60*24*365);
setcookie("name",$_POST['name'],time()+60*60*24*365);
setcookie("middlename",$_POST['middlename'],time()+60*60*24*365);
setcookie("email",$_POST['email'],time()+60*60*24*365);
setcookie("telephone",$_POST['telephone'],time()+60*60*24*365);

if(isset($_POST['submit']))
{
    echo '<pre>';
    echo $_COOKIE["surname"];
    echo '<pre>';
    echo '<pre>';
    echo $_COOKIE["name"];
    echo '<pre>';
    echo '<pre>';
    echo $_COOKIE["middlename"];
    echo '<pre>';
    echo '<pre>';
    echo $_COOKIE["email"];
    echo '<pre>';
    echo '<pre>';
    echo $_COOKIE["telephone"];
    echo '<pre>';
    echo $_POST['surname'];
}
///local/components/my/cart/templates/.default/template.php

?>
<form method="post" action="/local/components/my/cart/templates/.default/template.php">
    <div>
        <label for="surname">Фамилия:</label>
        <input type="text" name="surname" id="surname" pattern="([А-Я][a-я]+)">
    </div>
    <div>
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" pattern="([А-Я][a-я]+)">
    </div>
    <div>
        <label for="middlename">Отчество:</label>
        <input type="text" name="middlename" id="middlename" pattern="([А-Я][a-я]+)">
    </div>
    <div>
        <label for="email">E-Mail:</label>
        <input type="text" name="email" id="email" required pattern="[a-z\A-Z\1-9\-\.\_]+@[a-z1-9]+(.[a-z]+){1,}">
    </div>
    <div>
        <label for="telephone">Телефон:</label>
        <input type="text" name="telephone" id="telephone" required pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$">
    </div>

    <input type="submit" name="submit" value="Оформить заказ">
</form>
