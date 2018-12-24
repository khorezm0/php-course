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

if($id){
    $data = getItem($id);
    $isData = $data && count($data) > 0;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <? renderHeader(); ?>

    <script>
		/*ADD*/
        var type = "";
        function clckAdd(typ) {
            type = typ;
        }
        function addType(el) {
            var naming = document.getElementById("naming").value;
            var select = document.getElementById(type);
            $.get( "back/admin.php?create="+encodeURIComponent(type)+"&value="+ encodeURIComponent(naming),
                function( data ) {
                    //$( ".result" ).html( data );
                    console.log( "Load was performed. " + data);

                    var op = document.createElement('option');
                    op.value = data;
                    op.innerText = naming;
                    select.appendChild(op);
                    
                    document.getElementById("addStatus").style.display = "block";
                    document.getElementById("addStatusText").innerText = "Готово";
                    setTimeout(function(){ $("#createModal").modal("hide");document.getElementById("addStatus").style.display = "none"; }, 1000);
                }
            );
            
			document.getElementById("addStatus").style.display = "block";
			document.getElementById("addStatusText").innerText = "Сохранение...";
            console.log("SEND "+naming);
        }
        
        /*EDIT OR DELETE*/
        var editText = "";
        var editValue = "";
        
		function clckEdit(typ) {
            type = typ;
            var select = document.getElementById(type);
            var i = select.options.selectedIndex;
            editText = select[i].text;
            editValue = select[i].value;
            document.getElementById("editNaming").value = editText;
        }
        
        function editType(el) {
            var naming = document.getElementById("editNaming").value;
            var select = document.getElementById(type);
            
			var _editValue = editValue;
            
            $.get( "back/admin.php?type="+encodeURIComponent(type)+"&edit="+encodeURIComponent(_editValue)+"&value="+ encodeURIComponent(naming),
                function( data ) {
                    //$( ".result" ).html( data );
                    console.log( "Load was performed. " + data);
                    for(var i = 0;i<select.options.length;i++){
						if(select.options[i].value == _editValue){
							select.options[i].text = naming;
						}
                    }
                    document.getElementById("editStatus").style.display = "block";
                    document.getElementById("editStatusText").innerText = "Готово";
                    setTimeout(function(){ $("#editModal").modal("hide");document.getElementById("editStatus").style.display = "none"; }, 1000);
                }
            );
			document.getElementById("editStatus").style.display = "block";
			document.getElementById("editStatusText").innerText = "Сохранение...";
            console.log("SEND "+naming);
        }
        
		function delType(el) {
            var select = document.getElementById(type);
			var _editValue = editValue;
            
            $.get( "back/admin.php?type="+encodeURIComponent(type)+"&del="+encodeURIComponent(_editValue),
                function( data ) {
                    //$( ".result" ).html( data );
                    console.log( "Load was performed. " + data);
                    for(var i = 0;i<select.options.length;i++){
						if(select.options[i].value == _editValue){
							select.options.remove(i);
						}
                    }
                    document.getElementById("editStatus").style.display = "block";
                    document.getElementById("editStatusText").innerText = "Готово";
                    setTimeout(function(){ $("#editModal").modal("hide");document.getElementById("editStatus").style.display = "none"; }, 1000);
                }
            );
			document.getElementById("editStatus").style.display = "block";
			document.getElementById("editStatusText").innerText = "Сохранение...";
            console.log("SEND "+naming);
        }
        
    </script>

</head>

<body class="main-page">

<? renderTop(); ?>

<div class="content container">
    <div class="flex-wrap mb-md-5 my-5 row">
        <form class="col admin-form">
             
            <h3 class="mb-3"><?=($isData) ? ("Редактирование предмета: #" . strval($data['id'])) : ("Новый элемент") ?></h3>
            <div class="ml-md-4 mr-md-4 row mb-3">
                <label for="name" class="col-2 mb-0 mr-3">Название:</label>
                <input id="name" type="text" class="form-control col-4" placeholder="Введите название" value="<?=$data['name']?>" />
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
                <label for="size" class="col-2 mb-0 mr-3">Размер:</label>
                <select name="size" id="size" class="col-4 form-control">
                    <? foreach (getSizes() as $r) { ?>
                        <option <?=($isData && $data['size_id'] == $r['id']) ? "selected" : ""?> value="<?=$r["id"]?>" ><?=$r['name']?></option>
                    <? } ?>
                </select>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#editModal" onclick="clckEdit('size')"><i class="material-icons">edit</i></button>
                <button class="btn btn-link d-inline-flex" type="button" data-toggle="modal" data-target="#createModal" onclick="clckAdd('size')"><i class="material-icons">add</i></button>
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
        </form>
    </div>
    <div class="row flex-grow-1 flex-wrap flex-column mb-4">
        <h3 class="mb-3">Изображения</h3>
        <div class="row flex-grow-1 justify-content-center">
            <div class="col-auto justify-content-center d-flex position-relative mb-2">
                <img src="images/150.png" class="item-image"/>
                <label for="img" class="position-absolute fixed-bottom text-center upload-button">Загрузить</label>
                <input id="img" style="visibility: hidden;position: absolute;" type="file">
            </div>
            <? foreach (getItemImages($id) as $i){ ?>
                <div class="col-auto justify-content-center d-flex position-relative mb-2">
                    <img src="<?=$i['url']?>" class="item-image"/>
                    <div class="position-absolute fixed-bottom text-center delete-button">Удалить</div>
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