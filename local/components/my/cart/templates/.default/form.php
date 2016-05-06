<?php

if (isset($_POST["name"])) {
    //Данные отправляются в кодировке utf-8, поэтому конвертим в cp1251

    echo '<pre>';
    echo $_POST["surname"];
    echo '<pre>';
    echo '<pre>';
    echo $_POST["name"];
    echo '<pre>';
    echo '<pre>';
    echo $_POST["middlename"];
    echo '<pre>';
    echo '<pre>';
    echo $_POST["email"];
    echo '<pre>';
    echo '<pre>';
    echo $_POST["telephone"];
    echo '<pre>';
    echo $_POST['surname'];
    //echo "Ваш телефон: " . $_POST["phone"] . "<br/>";
    //echo "Ваш сайт: " . $_POST["site"] . "<br/>";
}
?>