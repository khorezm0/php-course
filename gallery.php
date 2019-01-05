<?php

require_once 'back/db.php';
require_once 'back/page-settings.php';
require_once 'back/header.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';
require_once 'back/utils.php';

$page_title = "Галлерея";

?>

<html>

<head>
    <? renderHeader(); ?>
</head>

<body class="main-page">

    <? renderTop(); ?>

    <div class="content container">


    <? shopList("&#x1F525; Популярные:",getPopulars(),"auto-shop-list") ?>

    <?
    $cats = getCategories();
    foreach ($cats as $c){
        if(intval($c['id']) > 1){
            $list = getItemsByCategory($c['id'], 3);
            shopList($c['name'],$list,"auto-shop-list");
        }
    }
    ?>

    </div>

<? renderBottom(); ?>

</body>

</html>
