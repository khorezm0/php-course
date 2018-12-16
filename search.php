<?php

require_once 'back/page-settings.php';
require_once 'back/header.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';

$page_title = "Template";

?>

<html>

<head>
    <? renderHeader(); ?>
</head>

<body class="main-page">

    <? renderTop(); ?>

    <div class="content container">

        <div class="container">
            <br/>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <form class="card card-sm">
                        <div class="card-body row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-search h4 text-body"></i>
                            </div>
                            <div class="col">
                                <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Поиск товаров">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-lg btn-success" type="submit">Поиск</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <? shopList("Результаты:",[
        [
            "image" => "/coursephp/images/shop/i0000000001.jpg",
            "name" => "Гранат",
            "category" => "холст / масло / 40x40см",
            "price" => 1000
        ],
        [
            "image" => "/coursephp/images/shop/i0000000002.jpg",
            "name" => "Гранат",
            "category" => "холст / масло / 40x40см",
            "price" => 1000
        ],
        [
            "image" => "/coursephp/images/shop/i0000000003.jpg",
            "name" => "Гранат",
            "category" => "холст / масло / 40x40см",
            "price" => 1000
        ],
    ],"") ?>

    </div>

<? renderBottom(); ?>

</body>

</html>
