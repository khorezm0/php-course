<?php
    require_once "db.php";
    require_once "utils.php";
    require_once "users.php";


    $showOrder = false;

    if(isset($_GET['make']) && $_SESSION['isUser']){

        $summ = getCartSummary();
        $user = $_SESSION['id'];
        $addr = $_POST['address'];

        $q = "INSERT INTO `orders` (date, user_id, address, price) VALUES (now(), '$user', '$addr', '".$summ['sum']."')";
        $res = mysql_query($q);
        if($res){
            $id = mysql_insert_id();
            $cart = getMinCart();
            if(!$cart || count($cart) < 1) {
                header('Location: /coursephp/cart.php');
                die();
            }
            clearCart();
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Чек заказа</title>
    <link rel="stylesheet" href="/coursephp/css/pure-min.css">
    <link rel="stylesheet" href="/coursephp/css/tables-min.css">
    <script src="/coursephp/js/jquery.min.js"></script>
</head>
<body>
<div id="printElement">
    <p>Заказ был оформлен!</p>
    <p><?=date('d-m-Y H:i:s');?></p>
    <p>Товары:</p>

    <table class="pure-table">

        <thead>
        <tr>
            <th>#</th>
            <th>Наименование</th>
            <th>Кол-во</th>
            <th>Цена</th>
        </tr>
        </thead>

        <tbody>


<?
            $i = 0;
            foreach ($cart as $c){
                $i ++;
                $q = "INSERT INTO `orders_items` (item_id, order_id, count) VALUES ('".$c['id']."', '$id', '".$c['count']."')";
                $res = mysql_query($q);
                if($res){
?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$c['name']?></td>
                        <td><?=$c['count']?></td>
                        <td><?=$c['count'] * $c['price']?></td>
                    </tr>

<?
                }
            }
        }
    }
?>

    <tr>
        <td>-</td>
        <td>Всего</td>
        <td><?=$summ['count']?></td>
        <td><?=$summ['sum']?></td>
    </tr>

        </tbody>
    </table>

    <p>Спасибо за покупку!</p>
</div>

<script>print();</script>

</body>
</html>
