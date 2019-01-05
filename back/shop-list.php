<?php

    require_once "users.php";

    function shopList($title,$arr,$list_class){
        shopListWithButton($title, $arr, $list_class, FALSE);
    }

    function shopListWithButton($title,$arr,$list_class,$isCart)
    {
       if($isCart) {
           global $totalSum;
           global $totalCount;
       }

        $user = $_SESSION['id'];

    ?>

        <div class="container-fluid regular-list <?=$list_class?>">
            <div class="regular-list-inner">
                <h4 class="title text-center text-md-left"><?=$title?></h4>
                <div class="container-fluid flex-wrap d-flex">

                    <?
					if($arr)
                    foreach ($arr as &$el) {

                        ?>
                        <div class="col">
                            <div class="regular-list-item">
                                <a href="<?='item.php?id='.$el['id']?>" class="image" style="background-image: url('<?=$el['image']?>')"></a>
                                <a href="<?='item.php?id='.$el['id']?>" class="item-title"><?=$el['name']?></a>
                                <p class="text-info"><?=$el['tags']?></p>
                                <span class="price"><?=$el['price']?> руб</span>

                                <? if(isInCart($el['id'], $user)){ ?>
                                    <a href="<?='cart.php?rem='.$el['id']?>" class="item-icon cart-btn"><i class="material-icons">remove_shopping_cart</i></a>
                                <? } else { ?>
                                    <a href="<?='cart.php?add='.$el['id']?>" class="item-icon cart-btn"><i class="material-icons">shopping_cart</i></a>
                                <? } ?>
                                <a href="<?='item.php?id='.$el['id']?>" class="item-icon read-more-btn"><i
                                        class="material-icons">arrow_forward_ios</i></a>
                            </div>
                        </div>
                        <?
                    }

                    ?>
                </div>

                <? if($isCart){
                    ?>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item active p-4 text-center" aria-current="page">
                                <h5 class="font-weight-bold"><?=$totalCount?> товаров на сумму <?=$totalSum?></h5>
                                <br>
                                <form method="post" action="/coursephp/back/order.php?make">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Адрес</label>
                                        <textarea  name="address" required minlength="10" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    <button  type="submit" class="btn btn-primary">Оформить</button>
                                </form>
                                <br>
                                <span class="font-weight-light h6 mt-2 d-block" style="font-size: 11px;">Нажимая на кнопку «Оформить», вы принимаете условия Публичной оферты</span>
                            </li>
                        </ol>
                    </nav>
                <? }?>

            </div>
        </div>

    <?
    }
?>
