<?
CModule::IncludeModule("sale");

class CDeliveryBestCourier
{
    function Init()
    {
        return array(
            /* Основное описание */
            "SID" => "best",
            "NAME" => "Лучшая доставка в мире",
            "DESCRIPTION" => "",
            "DESCRIPTION_INNER" =>
                "Простой обработчик курьерской доставки. Для функционирования необходимо "
                ."наличие хотя бы одной группы местоположений. При настройке обработчика указывается "
                ."фиксированная стоимость доставки для каждой группы местоположений. Для того, чтобы "
                ."группа не участвовала в обработке, оставьте пустым поле стоимости для этой группы."
                ."<br />"
                ."<a href=\"/bitrix/admin/sale_location_group_admin.php?lang=ru\" target=\"_blank\">"
                ."Редактировать группы местоположений"
                ."</a>.",
            "BASE_CURRENCY" => COption::GetOptionString("sale", "default_currency", "RUB"),

            "HANDLER" => __FILE__,

            /* Методы обработчика */
            "DBGETSETTINGS" => array("CDeliveryBestCourier", "GetSettings"),
            "DBSETSETTINGS" => array("CDeliveryBestCourier", "SetSettings"),
            "GETCONFIG" => array("CDeliveryBestCourier", "GetConfig"),

            "COMPABILITY" => array("CDeliveryBestCourier", "Compability"),
            "CALCULATOR" => array("CDeliveryBestCourier", "Calculate"),

            /* Список профилей доставки */
            "PROFILES" => array(
                "courier" => array(
                    "TITLE" => "Доставка курьером",
                    "DESCRIPTION" => "Срок доставки до 3 дней",

                    "RESTRICTIONS_WEIGHT" => array(0), // без ограничений
                    "RESTRICTIONS_SUM" => array(0), // без ограничений
                ),
            )
        );
    }

    // настройки обработчика
    function GetConfig()
    {

        return array();
    }

    // подготовка настроек для занесения в базу данных
    function SetSettings($arSettings)
    {
        return serialize($arSettings);
    }

    // подготовка настроек, полученных из базы данных
    function GetSettings($strSettings)
    {
        // вернем десериализованный массив настроек
        return unserialize($strSettings);
    }

    // введем служебный метод, определяющий группу местоположения и возвращающий стоимость для этой группы.
    function __GetLocationPrice($LOCATION_ID, $arConfig)
    {
        // получим список групп для переданного местоположения
        $dbLocationGroups = CSaleLocationGroup::GetLocationList(array("LOCATION_ID" => $LOCATION_ID));

        while ($arLocationGroup = $dbLocationGroups->Fetch())
        {
            if (
                array_key_exists('price_'.$arLocationGroup["LOCATION_GROUP_ID"], $arConfig)
                &&
                strlen($arConfig['price_'.$arLocationGroup["LOCATION_GROUP_ID"]]["VALUE"] > 0)
            )
            {
                // если есть непустая запись в массиве настроек для данной группы, вернем ее значение
                return $arConfig['price_'.$arLocationGroup["LOCATION_GROUP_ID"]]["VALUE"];
            }
        }

        // если не найдено подходящих записей, вернем false
        return false;
    }

    // метод проверки совместимости в данном случае практически аналогичен рассчету стоимости
    function Compability($arOrder, $arConfig)
    {
        $arLocs = CSaleLocation::GetByID($arOrder['LOCATION_TO']);
        echo '<pre>';
        print_r($arLocs);
        echo '</pre>';
        $price = 0;
        $time = intval(date("H"));
        $zaglav = substr($arLocs['CITY_NAME'], 0);
        //if($arLocs['CITY_NAME'] == )
        //if($arLocs['CITY_NAME'] == )
        /*
        $dbAccountCurrency = CSaleBasket::GetList(
            array(),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => "s1",
                "ORDER_ID" => "NULL"
            )
        );
        while ($arAccountCurrency = $dbAccountCurrency->Fetch())
        {
            $price += $arAccountCurrency['PRICE'] * $arAccountCurrency['QUANTITY'];
        }*/
        echo "<pre>";
        print_r($price);
        echo "</pre>";
        if($time < 12)
        {
            $value = 100;
        }
        else
        {
            $value = intval($price) * 0.25;
        }
        return array('courier');
        // проверим наличие стоимости доставки
        $price = CDeliveryBestCourier::__GetLocationPrice($arOrder["LOCATION_TO"], $arConfig);
        if ($price === false)
            return array(); // если стоимость не найдено, вернем пустой массив - не подходит ни один профиль
        else
            return array('simple'); // в противном случае вернем массив, содержащий идентфиикатор единственного профиля доставки
    }

    // собственно, рассчет стоимости
    function Calculate($profile, $arConfig, $arOrder, $STEP, $TEMP = false)
    {
        // служебный метод рассчета определён выше, нам достаточно переадресовать на выход возвращаемое им значение.
        return array(
            "RESULT" => "OK",
            "VALUE" => 100, //CDeliveryBestCourier::__GetLocationPrice($arOrder["LOCATION_TO"], $arConfig)
        );
    }
}


AddEventHandler("sale", "onSaleDeliveryHandlersBuildList", array('CDeliveryBestCourier', 'Init'));