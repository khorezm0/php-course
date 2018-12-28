<?php

require_once 'back/header.php';
require_once 'back/db.php';
require_once 'back/page-settings.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';
require_once 'back/users.php';
require_once 'back/utils.php';

$page_title = "СарИсскуство";

if(!$_SESSION["isAdmin"]){
	header("Location: login.php?admin");
	die();
}

$id = parseGet($_GET['id']);
$isData = false;
$data = [];

$isSaved = false;
$SavedStyle = "success";
$SavedMessage = "";

if($id && isset($_GET['edit'])){
    $name = parseGet($_POST['name']);
    $price = parseGet($_POST['price']);
    $category = parseGet($_POST['category']);
    $genre = parseGet($_POST['genre']);
    $style = parseGet($_POST['style']);
    $author = parseGet($_POST['author']);
    $material = parseGet($_POST['material']);
    $size = parseGet($_POST['size']);
    $hidden = parseGet($_POST['hidden']);

    if($name && isset($price) && $category && $genre && $style && $size && $material && isset($hidden) && $author &&
        updateItem($id, $name, $price, $category, $genre, $style, $size, $material, $hidden, $author)){
        $isSaved = true;
        $SavedMessage = "Сохранение успешно!";
    }else{
        $isSaved = true;
        $SavedMessage = "Ошибка сохранения! " . mysql_error();
        $SavedStyle = "warning";
    }
}

if($id){
    $data = getItem($id);
    $isData = $data && count($data) > 0;
}

if(!$id || !$isData){
    $data = getNewItem();
    header("Location: item-edit.php?id=".$data['id']);
    die(mysql_error());
}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <? renderHeader(); ?>

    <script> var itemId = '<?=$id?>'; </script>
    <script src="js/item-editing-modals.js"></script>
    <script src="js/item-image-uploader.js"></script>

</head>

<body class="main-page">

<? renderTop(); ?>

<div class="content container">
    <? if($isSaved) { ?>
        <div class="alert alert-<?=$SavedStyle?>" role="alert">
            <strong><?=$SavedMessage?></strong>
        </div>
    <? } ?>
    <div class="flex-wrap mb-md-5 my-5 row">
        <form class="col admin-form" action="item-edit.php?id=<?=$data['id']?>&edit" method="post">
            <h3 class="mb-3"><?="Предмет #" . strval($data['id'])?></h3>
            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="name" class="col-2 mb-0 mr-3">Название:</label>
                <input id="name" name="name" type="text" class="form-control col-4" placeholder="Введите название" value="<?=$data['name']?>" />
            </div>

            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="price" class="col-2 mb-0 mr-3">Цена:</label>
                <input id="price" name="price" type="number" class="form-control col-4" placeholder="Сумма" value="<?=$data['price']?>" />
            </div>

            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="size" class="col-2 mb-0 mr-3">Размер:</label>
                <input id="size" name="size" type="text" class="form-control col-4" placeholder="Размер" value="<?=$data['size']?>" />
            </div>

            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="category" class="col-2 mb-0 mr-3">Категория:</label>
                <select name="category" id="category" class="col-4 form-control">
                    <? foreach (getCategories() as $r) { ?>
                        <option <?=($isData && $data['category_id'] == $r['id']) ? "selected" : ""?>  value="<?=$r["id"]?>" ><?=$r['name']?></option>
                    <? } ?>
                </select>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#editModal" onclick="clckEdit('category')"><i class="material-icons">edit</i></button>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#createModal" onclick="clckAdd('category')"><i class="material-icons">add</i></button>
            </div>

            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="genre" class="col-2 mb-0 mr-3">Жанр:</label>
                <select name="genre" id="genre" class="col-4 form-control">
                    <? foreach (getGenres() as $r) { ?>
                        <option <?=($isData && $data['genre_id'] == $r['id']) ? "selected" : ""?> value="<?=$r["id"]?>" ><?=$r['name']?></option>
                    <? } ?>
                </select>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#editModal" onclick="clckEdit('genre')"><i class="material-icons">edit</i></button>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#createModal" onclick="clckAdd('genre')"><i class="material-icons">add</i></button>
            </div>

            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="style" class="col-2 mb-0 mr-3">Стиль:</label>
                <select name="style" id="style" class="col-4 form-control">
                    <? foreach (getStyles() as $r) { ?>
                        <option <?=($isData && $data['style_id'] == $r['id']) ? "selected" : ""?> value="<?=$r["id"]?>" ><?=$r['name']?></option>
                    <? } ?>
                </select>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#editModal" onclick="clckEdit('style')"><i class="material-icons">edit</i></button>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#createModal" onclick="clckAdd('style')"><i class="material-icons">add</i></button>
            </div>

            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="author" class="col-2 mb-0 mr-3">Автор:</label>
                <select name="author" id="author" class="col-4 form-control">
                    <? foreach (getAuthors() as $r) { ?>
                        <option <?=($isData && $data['author_id'] == $r['id']) ? "selected" : ""?> value="<?=$r["id"]?>" ><?=$r['name']?></option>
                    <? } ?>
                </select>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#editModal" onclick="clckEdit('author')"><i class="material-icons">edit</i></button>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#createModal" onclick="clckAdd('author')"><i class="material-icons">add</i></button>
            </div>

            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="material" class="col-2 mb-0 mr-3">Материал:</label>
                <select name="material" id="material" class="col-4 form-control">
                    <? foreach (getMaterials() as $r) { ?>
                        <option <?=($isData && $data['material_id'] == $r['id']) ? "selected" : ""?> value="<?=$r["id"]?>" ><?=$r['name']?></option>
                    <? } ?>
                </select>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#editModal" onclick="clckEdit('material')"><i class="material-icons">edit</i></button>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#createModal" onclick="clckAdd('material')"><i class="material-icons">add</i></button>
            </div>

            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="visibility" class="col-2 mb-0 mr-3">Видимость:</label>
                <select name="hidden" id="visibility" class="col-4 form-control">
                    <option value="0">Видимый</option>
                    <option value="1">Скрыт</option>
                </select>
            </div>
            <!--<div class="ml-md-4 mr-md-4 row mb-3">
                <label for="paint" class="col-2 mb-0 mr-3">Краски:</label>
                <select name="paint" id="paint" class="col-4 form-control">
                    <option>Масло</option>
                    <option>Акварель</option>
                    <option>Гуашь</option>
                </select>
                <button class="btn btn-link" type="button" data-toggle="modal" data-target="#exampleModal">+</button>
            </div>-->
            <button type="submit" class="mt-4 btn btn-primary">Сохранить</button>
            <a href="item.php?id=<?=$data['id']?>" class="mt-4 btn btn-link">Просмотр</a>
        </form>
    </div>
    <div class="row flex-grow-1 flex-wrap flex-column mb-4">
        <h3 class="mb-3">Изображения</h3>
        <div id="imgs-uploaded-alert" class="alert alert-success" role="alert" style="display: none;">
            <strong>Изображения загружены, сохраните изменения выше.</strong>
        </div>
        <div class="row flex-grow-1 justify-content-center item-images-list">
            <div id="images-upload" class="col-auto justify-content-center d-flex position-relative mb-2">
                <img src="images/150.png" class="item-image"/>
                <label for="img" class="position-absolute fixed-bottom text-center upload-button">Загрузить</label>
                <input id="img" style="visibility: hidden;position: absolute;" type="file" name="images[]" multiple max="" >
                <img id="img-loader" src="images/loader.gif" class="loader-absolute-center" style="display: none">
            </div>
            <? foreach (getItemImages($id) as $i){ ?>
                <div class="col-auto justify-content-center position-relative mb-2" id="img-<?=$i['id']?>">
                    <img src="<?=$i['url']?>" class="item-image"/>
                    <div class="position-absolute fixed-bottom text-center delete-button" onclick="sendDeleteImage(<?=$i['id']?>)">Удалить</div>
                </div>
            <? } ?>
        </div>
    </div>
</div>

<? renderBottom(); ?>

<!-- Modal create type -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">

	<div class="alert alert-success" style="display:none;" id="addStatus">
		<strong id="addStatusText">Загрузка.</strong>
	</div>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Создать элемент</h5>
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
                <button type="button" class="btn btn-primary" onclick="addType(this)">Добавить</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal edit type -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
<div class="alert alert-success" style="display:none;" id="editStatus">
	<strong id="editStatusText">Загрузка.</strong>
</div>
	
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Изменить элемент</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="ml-md-4 mr-md-4 row mb-3 justify-content-center">
                    <label for="editNaming" class="d-inline-flex col-auto mb-0 mr-3 align-items-center">Название:</label>
                    <input id="editNaming" type="text" class="form-control col-auto" placeholder="Введите название" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary" onclick="delType(this)">Удалить</button>
                <button type="button" class="btn btn-red" onclick="editType(this)">Сохранение</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>