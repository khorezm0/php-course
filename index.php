<?php

require_once 'back/page-settings.php';
require_once 'back/header.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';

$page_title = "СарИсскуство";



?>

<!DOCTYPE html>
<html lang="ru">

    <head>
        <? renderHeader(); ?>
    </head>

    <body class="main-page">

        <? renderTop(); ?>

        <div id="main-page-carousel" class="container-fluid main-sales carousel slide" data-ride="carousel" data-interval="3000">

            <!--bottom buttons-->
            <ol class="carousel-indicators">
                <li data-target="#main-page-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#main-page-carousel" data-slide-to="1"></li>
                <li data-target="#main-page-carousel" data-slide-to="2"></li>
            </ol>

            <!--carousel buttons-->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="slide"  style="background-image: url('images/slides/1.jpg')"></div>
                    <div class="carousel-caption d-none d-md-block">
                        <p>
                            В галерее выставлены на продажу работы более 650 авторов - более 19500 произведений искусства:
                            <br>
                            живопись, акварель, пастель, гуашь, гравюра, скульптура, батик, гобелен, витраж, мозаика и авторская керамика.
                            <br>
                            У нас вы можете купить готовую картину или заказать копию любимой картины, портрет или художественную роспись стен.
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slide"  style="background-image: url('images/slides/2.jpg')"></div>
                    <div class="carousel-caption d-none d-md-block">
                        <p>
                            Каждая картина наполнена своей неповторимой гармонией, позитивной энергией цвета и фактуры,
                            <br>
                            которые позволяют глубже почувствовать эмоциональное состояние художника
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slide"  style="background-image: url('images/slides/3.jpg')"></div>
                    <div class="carousel-caption d-none d-md-block">
                        <p>
                            Созерцая их, вы каждый раз открываете для себя что-то новое...
                            <br>
                            Поэтому покупка картины - это поиск «друга», а также - замечательный подарок для всех случаев жизни
                        </p>
                    </div>
                </div>
            </div>

            <!--Left right buttons-->
            <a class="carousel-control-prev" href="#main-page-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#main-page-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <? shopList("Результаты:",[
            [
                "image" => "/coursephp/images/shop/i0000000001.jpg",
                "name" => "Гранат",
                "tags" => "холст / масло / 40x40см",
                "price" => 1000
            ],
            [
                "image" => "/coursephp/images/shop/i0000000002.jpg",
                "name" => "Гранат",
                "tags" => "холст / масло / 40x40см",
                "price" => 1000
            ],
            [
                "image" => "/coursephp/images/shop/i0000000003.jpg",
                "name" => "Гранат",
                "tags" => "холст / масло / 40x40см",
                "price" => 1000
            ],
        ],"") ?>

        <? renderBottom(); ?>
    </body>
</html>