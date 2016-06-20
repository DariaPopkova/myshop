<? foreach ($arResult as $category): ?>
    <h2><? echo $category['NAME']; ?></h2>
    <div id="cartfon" class="cart_aj">
        <div id="pokupka">
            <div id="price_cart">
                <div class="prop_naz_cart"><h3>Цена:</h3></div>
                <div class="prop_cart" id="price_for">
                    <? echo $category['CATALOG_PRICE_1'] . " " . $category['CATALOG_CURRENCY_1']; ?>
                </div>
            </div>
        </div>
        <p id="knop">
            <button name="butbay" id="but">Купить</button>
        </p>
        <a href="" id="basket" class="basket" >Добавить в корзину</a>
        <div id="imgcart"><img src="<?= $category['DETAIL_PICTURE']; ?>"></div>
        <div id="opisanie">
            <div class="prop_tov"><? echo $category['PROPERTIES']['CHARACTERISTICS']['DISPLAY_VALUE']; ?></div>
        </div>
        <div id="skald">
            <div class="prop_naz_sk">Количество:</div>
            <span class="minus">-</span>
            <input type="text" value="1"  size="2" id="number_kol" >
            <span class="plus">+</span>
            <div class="residue">Остаток:</div>
            <div id="residue_znach"><?=$category['CATALOG_QUANTITY']?></div>
        </div>

        <div id="char">
            <div id="naz_cart">
                <div class="prop_naz">Цвет:</div>
                <div class="prop_naz">Артикул:</div>
                <div class="prop_naz">Производитель:</div>
                <div class="prop_naz">Бренд:</div>
            </div>
            <div class="prop_tov"><? echo $category['PROPERTIES']['DESCRIPTION']['DISPLAY_VALUE']; ?></div>
            <div class="prop_tov"><? echo $category['PROPERTIES']['ARTNUMBER']['DISPLAY_VALUE']; ?></div>
            <div class="prop_tov"><? echo $category['PROPERTIES']['MANUFACTURER']['DISPLAY_VALUE']; ?></div>
            <div class="prop_tov"><? echo $category['PROPERTIES']['BRAND_REF']['DISPLAY_VALUE']; ?></div>
        </div>


    </div>
<? endforeach; ?>

<form method="post" id="formsub" action="">
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
        <input type="text" name="telephone" id="telephone" required
               pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$">
    </div>

    <input type="submit" name="submit" id="submit" value="Оформить заказ" >
</form>

<? include 'form.php'; ?>
<?include 'col_basket_element.php';?>
<div id="res"></div>


