<?php
require_once 'back/header.php';
require_once 'back/page-settings.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';
require_once 'back/users.php';

$page_title = "СарИсскуство";

if(!isLogined()){
	header("Location: login.php?needAuth");
}

$add = $_GET['add'];
$rem = $_GET['rem'];

if($add){
    addCart($add);
}
if($rem){
    remCart($rem);
}

?>

<html>

<head>
    <? renderHeader(); ?>
</head>

<body class="main-page">

<? renderTop(); ?>

<div class="content container">

    <? shopList("Корзина:", getCart() ,"") ?>

</div>

<? renderBottom(); ?>

</body>

</html>
