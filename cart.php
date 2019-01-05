<?php
require_once 'back/header.php';
require_once 'back/page-settings.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';
require_once 'back/users.php';
require_once 'back/utils.php';

$page_title = "СарИсскуство";

$add = $_GET['add'];
$rem = $_GET['rem'];

if(!isLogined() || !$_SESSION['isUser']){
    $url = "";
    if($add){
        $url = "&url=". urlencode ("cart.php?add=".$add);
    }
	header("Location: login.php?needAuth".$url);
}



if($add){
    addCart($add);
}
if($rem){
    remCart($rem);
}

$summary = getCartSummary();
$totalCount = $summary['count'];
$totalSum = number_format($summary['sum'], 0, ',', ' ') . " руб";

?>

<html>

<head>
    <? renderHeader(); ?>
</head>

<body class="main-page">

<? renderTop(); ?>

<div class="content container">

    <? shopListWithButton("Корзина:", getCart() ,"", TRUE) ?>

</div>

<? renderBottom(); ?>

</body>

</html>
