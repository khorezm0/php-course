<?php

require_once 'back/page-settings.php';
require_once 'back/header.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';
require_once 'back/db.php';
require_once 'back/utils.php';

$page_title = "СарИсскуство";

$data = 0;
$images = [];
$__id = parseGet($_GET['id']);

if($__id){
    $dataArr = getItem($__id);
    if($dataArr && count($dataArr) > 0) $data = $dataArr[0];
    $images = getItemImages($__id);
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <? renderHeader(); ?>
</head>

<body>

<? renderTop(); ?>
    <div class="container content item-page">

        <?
        if($__id) {
        ?>
            <div class="d-flex flex-row justify-content-center flex-wrap">
                <?
                    foreach ($images as $img) {
                        ?>
                        <div class="d-flex flex-row justify-content-center image-item">
                            <img src="<?=$img['url']?>">
                        </div>
                        <?
                    }
                ?>

            </div>
            <br>
            <div class="col">
                <div class="row">
                    <h1><?=$data['name']?></h1>
                </div>
                <br>
                <p class="text-body row"></p>
                <p class="text-info row"><?=$data['tags']?></p>
                <p class="font-weight-light row">Автор: <?=$data['author']?></p>
                <p class="d-flex font-weight-light flex-row align-items-center row">
                    Цена:
                    <span style="padding-right: 10px;"> </span>
                    <span class="btn btn-light"><?=$data['price']?> руб</span>
                </p>
                <br/>
                <p class="row">
                    <a href="#" class="btn btn-primary btn-lg" role="button">Купить</a>
                    <span style="padding-right: 10px;"> </span>
                    <a href="#" class="btn btn-secondary btn-lg d-inline-flex" role="button">
                        <i class="material-icons" style="padding-right: 4px;">shopping_cart</i>
                        В корзину
                    </a>
                </p>
            </div>

            <?
            } else {
            ?>
                <h2>Товар не найден</h2>
                <div class="row">
                    <a href="index.php" class="btn btn-secondary btn-lg d-inline-flex" role="button">
                        На главную
                    </a>
                </div>
                <?
            }
            ?>

    </div>

<? renderBottom(); ?>

</body>
</html>