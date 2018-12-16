<?php

require_once 'back/page-settings.php';
require_once 'back/header.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';

$page_title = "Галлерея";

?>

<html>

<head>
    <? renderHeader(); ?>
</head>

<body class="main-page">

    <? renderTop(); ?>

    <div class="content container">


    <? shopList("&#x1F525; Популярные:",[
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
    ],"auto-shop-list") ?>


    <? shopList("Холст / Масло:",[
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
    ],"auto-shop-list") ?>

    </div>

<? renderBottom(); ?>

</body>

</html>
