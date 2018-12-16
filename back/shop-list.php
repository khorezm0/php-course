<?php
    function shopList($title,$arr,$list_class)
    {
    ?>

        <div class="container-fluid regular-list <?=$list_class?>">
            <div class="regular-list-inner">
                <h4 class="title text-center text-md-left"><?=$title?></h4>
                <div class="container-fluid flex-wrap">

                    <?

                    foreach ($arr as &$el) {

                        ?>
                        <a href="#" class="col">
                            <div class="regular-list-item">
                                <div class="image" style="background-image: url('<?=$el['image']?>')">
                                </div>
                                <p class="item-title"><?=$el['name']?></p>
                                <p class="text-info"><?=$el['category']?></p>
                                <span class="price"><?=$el['price']?> руб</span>

                                <span class="item-icon cart-btn"><i class="material-icons">shopping_cart</i></span>
                                <span class="item-icon read-more-btn"><i
                                        class="material-icons">arrow_forward_ios</i></span>
                            </div>
                        </a>
                        <?
                    }

                    ?>

                </div>
            </div>
        </div>

    <?
    }
?>
