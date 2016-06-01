<? foreach ($arResult as $category): ?>

    <h2><? echo $category['NAME']; ?></h2>
    <div id="cartfon">
        <div id="pokupka">
            <div id="price_cart">
                <div class="prop_naz_cart"><h3>Цена:</h3></div>
                <div class="prop_cart">
                    <? echo $category['CATALOG_PRICE_1'] . " " . $category['CATALOG_CURRENCY_1']; ?>
                </div>
            </div>
        </div>
        <p id="knop">
            <button name="butbay" id="but">Купить</button>
        </p>
        <form method="post" action="">
            <input type="submit" name="basket" id="basket" value="Добавить в корзину" onclick="
            var val = $('#select option:selected').val();
            $('#select option').removeAttr('selected'); //Снимаем все выбранные элементы
                $('#select option[value='.val.']').attr('selected', 'selected'); //Выбираем элемент со значением value равным 4
                return false;">
        </form>
        <div id="imgcart"><img src="<?= $category['DETAIL_PICTURE']; ?>"></div>
        <div id="opisanie">
            <div class="prop_tov"><? echo $category['PROPERTIES']['CHARACTERISTICS']['DISPLAY_VALUE']; ?></div>
        </div>
        <div id="skald">
            <div class="prop_naz_sk">Доступно:</div>
            <!--<form id="formazak" method="get">-->
                <select name="option" id="select">
                    <? for ($i = 1; $i <= $category['CATALOG_QUANTITY']; $i++): ?>
                        <?if($i == 1)
                        {?>
                            <option selected="selected" value="<?= $i; ?>"><?= $i; ?></option>
                        <?}
                        else
                        {?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?}?>

                    <? endfor; ?>
                </select>
            <!--</form>-->


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

    <input type="submit" name="submit" id="submit" value="Оформить заказ" onclick="viv('formsub')">
</form>

<? include 'form.php'; ?>
<div id="res"></div>
<?
CModule::IncludeModule('iblock');
//CModule::IncludeModule('pokupki');

$array = [];
$array["surname"] = $_POST['surname'];
$array["name"] = $_POST['name'];
$array["middlename"] = $_POST['middlename'];
$array["email"] = $_POST['email'];
$array["telephone"] = $_POST['telephone'];
//print_r($array);
while ($value = current($array)) {
    $APPLICATION->set_cookie(
        key($array),
        $value,
        time() + 60 * 60 * 24 * 365
    );
    $VISITOR_ID = $APPLICATION->get_cookie(key($array));
    echo $VISITOR_ID;
    //echo $name.'<br />';
    next($array);
}
$res = CIBlock::GetList(
    Array(),
    Array(
        'TYPE' => 'pokupki',

    )
);
while ($ar_res = $res->Fetch()) {
    if (isset($_POST['name'])) {
        $el = new CIBlockElement;
        $arFields = Array(
            "IBLOCK_TYPE" => $ar_res['IBLOCK_TYPE_ID'],
            "IBLOCK_ID" => $ar_res['ID'],
            "NAME" => $_POST['name'],
            "PROPERTY_VALUES" => [
                "NAME_POS" => $_POST['name'],
                "SURNAME" => $_POST['surname'],
                "MIDLENAME" => $_POST['surname'],
                "EMAIL" => $_POST['email'],
                "PHONE" => $_POST['telephone'],
                "PRODUCT" => 'http://popkova.bitrix.develop.maximaster.ru/cart.php?IBLOCK_ID=<?=$_GET["IBLOCK_ID"];?>&find_section_section=<?=$_GET["find_section_section"];?>&ELEMENT_ID=<?=$_GET["ELEMENT_ID"];?>',
            ],
        );
        if ($id = $el->Add($arFields)) {
            echo "Успешно" . PHP_EOL;
            echo $id;
        } else {
            echo "Error: " . $el->LAST_ERROR . PHP_EOL;
        }
    } else {
        echo "Ошибка";
    }
}
//include 'addbasket.php';

if (isset($_POST['basket'])) {

    array_map('CModule::IncludeModule', ['iblock', 'catalog', 'sale']);
    $sectionID = $_GET['SECTION_ID'];
    $elementID = $_GET['ID'];
    $property = CIBlockElement::GetList(
        array(),
        array(
            "IBLOCK_ID" => IBLOCK_PRODUCTS,
            "SECTION_ID" => $sectionID,
            "ID" => $elementID,
        )
    );
    $ar_propprod = $property->Fetch();

    $price = CPrice::GetList(
        array(),
        array(
            "PRODUCT_ID" => $elementID,
        )
    );
    $ar_price = $price->Fetch();
    $product = CIBlockElement::GetList(
        array(),
        array(
            "ID" => $elementID
        )
    );
    $ar_pro = $product->Fetch();
    $option = isset($_GET['option']) ? (int)$_GET['option'] : 1;
    Add2BasketByProductID(
        $elementID,
        $option
    );
    $get_bask = CSaleBasket::GetList(
        array(),
        array(
            "PRODUCT_ID" => $elementID
        )
    );
    $ar_bask = $get_bask->Fetch();
}

?>
<script>
   /* function add_to_basket() {

        var value = $("select#select").val();
        $("#select option[value=4]").attr('selected', 'selected');
        alert(value);

    }*/


</script>

<script>
    /*
    $(document).ready(function(){
      function add_to_basket(){
            var value=jQuery("select#select").val();


            alert(val);
            $.ajax({
                type: 'POST',
                dataType: 'text',
                url: 'addbasket.php',
                data: {kol: "4"},
                success: function(data) {
                    alert(data);


                },
                error:function(xhr, status, errorThrown) {
                    alert(errorThrown+'\n'+status+'\n'+xhr.statusText);
                }
            });

        }
    });*/



</script>

