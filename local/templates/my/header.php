<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <?$APPLICATION->ShowHead();?>
    <title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div id="wrapper">
    <div id="firstcreen">
        <header>
            <div id="logo">

            </div>
            <div id="phone">

            </div>
            <div id="vremy">

            </div>
            <div id="reg">

            </div>
        </header>
        <?
        $APPLICATION->IncludeComponent(
            "my:menu",
            ".default",
            array(
                "ROOT_MENU_TYPE" => "top",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "top",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => ""
            ),
            false
        );

        ?>



        <nav>
            <ul id="v-menu">
                <li class="menu">
                    <span id="s1"></span>

                    <a href="#" class="menus">Для офиса</a>
                    <ul class="ot">
                        <li><a href="#">Ручки </a></li>

                        <li><a href="#">Карандаши</a></li>

                    </ul>

                </li>
                <li class="menu">
                    <a href="#">Для дома</a>
                    <ul class="ot">
                        <li><a href="#">Ручки </a></li>

                        <li><a href="#">Карандаши</a></li>
                        <li><a href="#">Ручки </a></li>

                        <li><a href="#">Карандаши</a></li>

                    </ul>

                </li>
                <li class="menu">
                    <a href="#">Для творчества</a>
                    <ul class="ot">
                        <li><a href="#">Ручки </a></li>

                        <li><a href="#">Карандаши</a></li>

                    </ul>

                </li>
                <li class="menu">
                    <a href="#">Для школы</a>
                    <ul class="ot">
                        <li><a href="#">Ручки </a></li>

                        <li><a href="#">Карандаши</a></li>

                    </ul>

                </li>


            </ul>


        </nav>

        <article>