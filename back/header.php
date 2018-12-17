
<?php

require_once 'page-settings.php';


function renderHeader()
{
    global $page_title;

    ?>

    <meta charset="UTF-8">
    <title><?= $page_title ?></title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">

    <script src="/coursephp/js/jquery.min.js"></script>
    <script src="/coursephp/js/popper.min.js"></script>
    <link rel="stylesheet" href="/coursephp/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/coursephp/css/bootstrap.min.css">
    <link rel="stylesheet" href="/coursephp/css/bootstrap-grid.min.css">

    <link rel="stylesheet" href="/coursephp/css/main.css">
    <link rel="stylesheet" href="/coursephp/css/medias.css">

    <script src="/coursephp/js/bootstrap.min.js"></script>

    <?
}

function renderTop()
{

    ?>

    <header class="container-fluid">
        <div class="row">
            <div class="col-2 logo-col"><img src="images/icon.png"></div>
            <div class="col-10">
                <div class="row header-upper-column">
                    <div class="col-2 page-title">SarИсскуство</div>

                    <!--PC and Tablet-->
                    <div class="col-6 d-none d-md-block d-lg-block"></div>
                    <button class="col-sm btn btn-link d-none d-md-block d-lg-block">
                        <i class="material-icons link-ico">face</i> Login
                    </button>
                    <button class="col-sm btn btn-link d-none d-md-block d-lg-block">
                        <i class="material-icons link-ico">perm_identity</i> Register
                    </button>
                    <div class="col-sm d-none d-md-block d-lg-block"></div>

                    <!--Mobile-->
                    <div class="col-4 d-md-none"></div>
                    <div class="col d-md-none flex-end-align">
                        <a href="search.php" class="btn btn-outline-light header-btn"><i class="material-icons">search</i></a>
                        <a href="cart.php" class="btn btn-outline-light header-btn"><i class="material-icons">shopping_cart</i></a>
                    </div>
                </div>
                <div class="row d-none d-md-flex d-lg-flex">
                    <div class="col-sm-3 col-md-2"><a href="/coursephp/index.php" class="btn btn-outline-light">Домашняя</a></div>
                    <div class="col"><a href="/coursephp/gallery.php" class="btn btn-outline-light outl-btn-disbaled">Галерея</a></div>
                    <!--<div class="col-sm"><a href="/coursephp/gallery.php" class="btn btn-outline-light outl-btn-disbaled">Заказ</a></div>-->
                    <div class="col-sm header-menu-btns">
                        <a href="search.php" class="btn btn-outline-light header-btn"><i class="material-icons">search</i></a>
                        <a href="cart.php" class="btn btn-outline-light header-btn"><i class="material-icons">shopping_cart</i></a>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <?
}
?>
