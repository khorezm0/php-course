<?php

    require_once "users.php";

    function shopList($title,$arr,$list_class)
    {

        $user = $_SESSION['id'];

    ?>

        <div class="container-fluid regular-list <?=$list_class?>">
            <div class="regular-list-inner">
                <h4 class="title text-center text-md-left"><?=$title?></h4>
                <div class="container-fluid flex-wrap">

                    <?

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
            </div>
        </div>

    <?
    }
?>
