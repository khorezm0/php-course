<?php

require_once 'back/db.php';
require_once 'back/page-settings.php';
require_once 'back/header.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';
require_once 'back/utils.php';

$page_title = "Поиск";

$q = parseGet($_POST['query']);
$lst =  extendedSearch($q, $_POST['categories'], $_POST['genres'], $_POST['styles'], $_POST['materials'], $_POST['authors'],$_POST['sizes'], $_POST['minPrice'], $_POST['maxPrice']);

$priceBounds = getBoundPrices();
if(isset($_POST['minPrice'])){
    $priceBounds['min'] = $_POST['minPrice'];
}
if(isset($_POST['maxPrice'])){
    $priceBounds['max'] = $_POST['maxPrice'];
}

?>

<html>

<head>
    <? renderHeader(); ?>
</head>

<body class="main-page">

    <? renderTop(); ?>

    <form class="content container" method="post">

        <div class="container">
            <br/>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card card-sm">
                        <div class="card-body row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-search h4 text-body"></i>
                            </div>
                            <div class="col">
                                <input class="form-control form-control-lg form-control-borderless" name="query" type="search" placeholder="Поиск товаров">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-lg btn-success" type="submit">Поиск</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row d-flex">
                <div class="col">

                    <label >Ценовой диапозон:</label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ОТ</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Минимальная цена" name="minPrice"  value="<?=$priceBounds['min']?>" aria-label="Минимальная цена">
                        <div class="input-group-append">
                            <span class="input-group-text">РУБ</span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ДО</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Максимальная цена" name="maxPrice"  value="<?=$priceBounds['max']?>" aria-label="Максимальная цена">
                        <div class="input-group-append">
                            <span class="input-group-text">РУБ</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex mt-4">
                <div class="col filter-list">
                    <div class="list-group-item list-group-item-dark"
                         data-toggle="collapse" href="#categoriesCollapse"
                         role="button" aria-expanded="false"
                         aria-controls="categoriesCollapse">Категории</div>
                    <div class="list-group list-group-flush filter-list-inner collapse" id="categoriesCollapse">
                        <? foreach (getCategories() as $c) {?>
                            <input id="categories[<?=$c['id']?>]" type="checkbox" name="categories[<?=$c['id']?>]" <?=(isset($_POST['categories'][$c['id']])) ? "checked" : ""?>>
                            <label for="categories[<?=$c['id']?>]" class="list-group-item"><span><?=$c['name']?></span></label>
                        <? } ?>
                    </div>
                </div>
                <div class="col filter-list">
                    <div class="list-group-item list-group-item-dark"
                         data-toggle="collapse" href="#authorsCollapse"
                         role="button" aria-expanded="false"
                         aria-controls="authorsCollapse">Автор</div>
                    <div class="list-group list-group-flush filter-list-inner collapse" id="authorsCollapse">
                        <? foreach (getAuthors() as $c) {?>
                            <input id="authors[<?=$c['id']?>]" type="checkbox" name="authors[<?=$c['id']?>]" <?=(isset($_POST['authors'][$c['id']])) ? "checked" : ""?>>
                            <label for="authors[<?=$c['id']?>]" class="list-group-item"><span><?=$c['name']?></span></label>
                        <? } ?>
                    </div>
                </div>
                <div class="col filter-list">
                    <div class="list-group-item list-group-item-dark"
                         data-toggle="collapse" href="#materialsCollapse"
                         role="button" aria-expanded="false"
                         aria-controls="materialsCollapse">Материал</div>
                    <div class="list-group list-group-flush filter-list-inner collapse" id="materialsCollapse">
                        <? foreach (getMaterials() as $c) {?>
                            <input id="materials[<?=$c['id']?>]" type="checkbox" name="materials[<?=$c['id']?>]" <?=(isset($_POST['materials'][$c['id']])) ? "checked" : ""?>>
                            <label for="materials[<?=$c['id']?>]" class="list-group-item"><span><?=$c['name']?></span></label>
                        <? } ?>
                    </div>
                </div>
            </div>

            <div class="row d-flex mt-4">
                <div class="col filter-list">
                    <div class="list-group-item list-group-item-dark"
                         data-toggle="collapse" href="#genresCollapse"
                         role="button" aria-expanded="false"
                         aria-controls="genresCollapse">Жанр</div>
                    <div class="list-group list-group-flush filter-list-inner collapse" id="genresCollapse">
                        <? foreach (getGenres() as $c) {?>
                            <input id="genres[<?=$c['id']?>]" type="checkbox" name="genres[<?=$c['id']?>]" <?=(isset($_POST['genres'][$c['id']])) ? "checked" : ""?>>
                            <label for="genres[<?=$c['id']?>]" class="list-group-item"><span><?=$c['name']?></span></label>
                        <? } ?>
                    </div>
                </div>
                <div class="col filter-list">
                    <div class="list-group-item list-group-item-dark"
                         data-toggle="collapse" href="#stylesCollapse"
                         role="button" aria-expanded="false"
                         aria-controls="stylesCollapse">Стиль</div>
                    <div class="list-group list-group-flush filter-list-inner collapse" id="stylesCollapse">
                        <? foreach (getStyles() as $c) {?>
                            <input id="styles[<?=$c['id']?>]" type="checkbox" name="styles[<?=$c['id']?>]" <?=(isset($_POST['styles'][$c['id']])) ? "checked" : ""?>>
                            <label for="styles[<?=$c['id']?>]" class="list-group-item"><span><?=$c['name']?></span></label>
                        <? } ?>
                    </div>
                </div>
                <div class="col filter-list">
                    <div class="list-group-item list-group-item-dark"
                         data-toggle="collapse" href="#sizesCollapse"
                         role="button" aria-expanded="false"
                         aria-controls="sizesCollapse">Размер</div>
                    <div class="list-group list-group-flush filter-list-inner collapse" id="sizesCollapse">
                        <? foreach (getSizes() as $c) {?>
                            <input id="sizes[<?=$c['id']?>]" value="<?=$c['size']?>" type="checkbox" name="sizes[<?=$c['id']?>]" <?=(isset($_POST['sizes'][$c['id']])) ? "checked" : ""?>>
                            <label for="sizes[<?=$c['id']?>]" class="list-group-item"><span><?=$c['size']?></span></label>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>

    <?
    if($lst && count($lst)) shopList("Рзультаты:", $lst ,"");
    else shopList("", [], "");
    ?>

    </form>

<? renderBottom(); ?>

</body>

</html>
