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

<body>

<? renderTop(); ?>

<div class="container content item-page">
    <div class="d-flex flex-row justify-content-center flex-wrap">

        <div class="d-flex flex-row justify-content-center image-item">
            <img src="images/shop/i0000000001.jpg">
        </div>
        <div class="d-flex flex-row justify-content-center image-item">
            <img src="images/shop/i0000000001.jpg">
        </div>
        <div class="d-flex flex-row justify-content-center image-item">
            <img src="images/shop/i0000000001.jpg">
        </div>
        <div class="d-flex flex-row justify-content-center image-item">
            <img src="images/shop/i0000000001.jpg">
        </div>

    </div>
    <br>
    <div class="col">
        <div class="row">
            <h1>Гранат</h1>
        </div>
        <br>
        <p class="text-body row">Летний петербург, мост, ночной петербург, пантелеймоновский мост, петербург, петербург гуашью, фонтанка</p>
        <p class="text-info row">экспрессионизм / натюрморт / холст / масло / 40x40см</p>
        <p class="font-weight-light row">Автор: Олигерова Анастасия</p>
        <p class="d-flex font-weight-light flex-row align-items-center row">
            Цена:
            <span style="padding-right: 10px;"> </span>
            <span class="btn btn-light">199 руб</span>
        </p>
        <br/>
        <p class="row">
            <a href="#" class="btn btn-primary btn-lg" role="button" >Купить</a>
            <span style="padding-right: 10px;"> </span>
            <a href="#" class="btn btn-secondary btn-lg d-inline-flex" role="button" ><i class="material-icons" style="padding-right: 4px;">shopping_cart</i> В корзину</a>
        </p>
    </div>
</div>

<? renderBottom(); ?>

</body>
</html>