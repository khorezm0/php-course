<?php

require_once 'back/page-settings.php';
require_once 'back/header.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';
require_once 'back/users.php';

$page_title = "СарИсскуство";

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <? renderHeader(); ?>
</head>

<body class="main-page">

<? renderTop(); ?>

<div class="content container">
    <div class="flex-wrap mb-md-5 my-5 row">
        <form class="col admin-form">
            <h3 class="mb-3">Редактирование предмета: #000213</h3>
            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="name" class="col-2 mb-0 mr-3">Название:</label>
                <input id="name" type="text" class="form-control col-4" placeholder="Введите название" value="Гранат" />
            </div>
            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="item-category" class="col-2 mb-0 mr-3">Категория:</label>
                <select name="item-category" id="item-category" class="col-4 form-control">
                    <option>Натюрморт</option>
                    <option>Пейзаж</option>
                    <option>Портреты</option>
                </select>
                <button class="btn btn-link" type="button" data-toggle="modal" data-target="#exampleModal">+</button>
            </div>
            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="author" class="col-2 mb-0 mr-3">Автор:</label>
                <select name="author" id="author" class="col-4 form-control">
                    <option>Нет</option>
                    <option>Васнецов</option>
                </select>
                <button class="btn btn-link" type="button" data-toggle="modal" data-target="#exampleModal">+</button>
            </div>
            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="mat" class="col-2 mb-0 mr-3">Материал:</label>
                <select name="mat" id="mat" class="col-4 form-control">
                    <option>Холст</option>
                </select>
                <button class="btn btn-link" type="button" data-toggle="modal" data-target="#exampleModal">+</button>
            </div>
            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="paint" class="col-2 mb-0 mr-3">Краски:</label>
                <select name="paint" id="paint" class="col-4 form-control">
                    <option>Масло</option>
                    <option>Акварель</option>
                    <option>Гуашь</option>
                </select>
                <button class="btn btn-link" type="button" data-toggle="modal" data-target="#exampleModal">+</button>
            </div>
            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="size" class="col-2 mb-0 mr-3">Размер:</label>
                <select name="size" id="size" class="col-4 form-control">
                    <option>40x40см</option>
                    <option>40x60см</option>
                </select>
                <button class="btn btn-link" type="button" data-toggle="modal" data-target="#exampleModal">+</button>
            </div>
            <button type="submit" class="mt-4 btn btn-primary">Сохранить</button>
        </form>
    </div>
    <div class="row flex-grow-1 flex-wrap flex-column mb-4">
        <h3 class="mb-3">Изображения</h3>
        <div class="row flex-grow-1 justify-content-center">
            <div class="col-auto justify-content-center d-flex position-relative mb-2">
                <img src="images/150.png" class="item-image"/>
                <div class="position-absolute fixed-bottom text-center upload-button">Загрузить</div>
            </div>
            <div class="col-auto justify-content-center d-flex position-relative mb-2">
                <img src="images/shop/i0000000001.jpg" class="item-image"/>
                <div class="position-absolute fixed-bottom text-center delete-button">Удалить</div>
            </div>
            <div class="col-auto justify-content-center d-flex position-relative mb-2">
                <img src="images/shop/i0000000001.jpg" class="item-image"/>
                <div class="position-absolute fixed-bottom text-center delete-button">Удалить</div>
            </div>
            <div class="col-auto justify-content-center d-flex position-relative mb-2">
                <img src="images/shop/i0000000001.jpg" class="item-image"/>
                <div class="position-absolute fixed-bottom text-center delete-button">Удалить</div>
            </div>
        </div>
    </div>
</div>

<? renderBottom(); ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создать элемент</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="ml-md-4 mr-md-4 row mb-3 justify-content-center">
                    <label for="naming" class="d-inline-flex col-auto mb-0 mr-3 align-items-center">Название:</label>
                    <input id="naming" type="text" class="form-control col-auto" placeholder="Введите название" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary">Добавить</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>