<?php

require_once 'back/header.php';
require_once 'back/page-settings.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';
require_once 'back/db.php';
require_once 'back/utils.php';
require_once 'back/users.php';

$page_title = "СарИсскуство";


if(!$_SESSION["isAdmin"]){
    header("Location: /coursephp/login.php?admin");
    die();
}

$page = 0;
if($_GET['page'] && intval($_GET['page'])){
    $page = intval($_GET['page']) - 1;
}
$perPage = 15;
$offset = $page * $perPage;

$q = "SELECT COUNT(id) AS count FROM `orders`";
$count = mysql_fetch_assoc(mysql_query($q))['count'];

$q = "SELECT `id`, (SELECT `name` FROM `user` WHERE user.id = orders.user_id) as `user`, `date`, `address`, `price`, `status` FROM `orders` LIMIT $perPage OFFSET $offset";
$orders = mysql_query($q);


?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <? renderHeader(); ?>
    <script>
        $(function() {
            $(".spoiler-trigger").click(function() {
                $(this).next().collapse('toggle');
            });
        });

        function statusChanged(id){
            let s = document.getElementById("orders-status-" + id);
            $.get( "back/admin.php?edit_item="+encodeURIComponent(id)+"&status="+encodeURIComponent(s.value),
                function( data ) {
                    console.log( "Load was performed. " + data);
                }
            );
        }
    </script>
</head>

<body>

<? renderTop(); ?>
    <div class="container content">

        <h1>Заказы</h1>

        <div class="table orders-table">
            <div class="row">
                <div class="col">#</div>
                <div class="col">Пользователь</div>
                <div class="col">Дата</div>
                <div class="col">Адрес</div>
                <div class="col">Сумма</div>
                <div class="col">Статус</div>
            </div>
            <?
            while($o = mysql_fetch_assoc($orders)){
                $its = mysql_query("SELECT items.id, name, price  FROM orders_items INNER JOIN items ON items.id = item_id WHERE order_id = '".$o['id']."'");
                ?>
                <div class="row spoiler-trigger" >
                    <div class="col"><?=$o["id"]?></div>
                    <div class="col"><?=$o["user"]?></div>
                    <div class="col"><?=$o["date"]?></div>
                    <div class="col"><?=$o["address"]?></div>
                    <div class="col"><?=$o["price"]?> РУБ</div>
                    <div class="col">
                        <select title="" id="orders-status-<?=$o['id']?>" onchange="statusChanged(<?=$o['id']?>)">
                            <option value="0" <?=$o['status'] == 0 ? "selected" : ""?>>В ожидании</option>
                            <option value="1" <?=$o['status'] == 1 ? "selected" : ""?>>Проверка</option>
                            <option value="2" <?=$o['status'] == 2 ? "selected" : ""?>>Отправка</option>
                            <option value="3" <?=$o['status'] == 3 ? "selected" : ""?>>Завершена</option>
                        </select>
                    </div>
                </div>
                <div class="inner-items-table panel-collapse collapse out">
                    <?
                    if(mysql_num_rows($its)) {
                        ?>
                        <div class="row inner-items">
                            <div class="col">#</div>
                            <div class="col">Товар</div>
                            <div class="col">Сумма</div>
                            <div class="col"><br></div>
                        </div>
                        <?
                    }
                    while ($i = mysql_fetch_assoc($its)) {
                        ?>
                        <a href="item.php?id=<?=$i['id']?>" target="_blank" class="row inner-items">
                            <div class="col"><?=$i['id']?></div>
                            <div class="col"><?=$i['name']?></div>
                            <div class="col"><?=$i['price']?> РУБ</div>
                            <div class="col flex-grow-1"><br></div>
                        </a>
                    <? } ?>
                </div>
            <? } ?>
        </div>
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2 d-flex justify-content-center">
                <?
                    $cpage = $page + 1;
                ?>
                <? if($cpage > 1) { ?><a href="?page=<?=$cpage - 1?>"><?=$cpage - 1?></a> <? } ?>
                <?=$cpage?>
                <? if($offset + $perPage < $count) { ?><a href="?page=<?=$cpage + 1?>"><?=$cpage + 1?></a> <? } ?>
            </div>
            <div class="col-5"></div>
        </div>
    </div>

<? renderBottom(); ?>

</body>
</html>