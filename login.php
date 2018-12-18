<?php

require_once 'back/header.php';
require_once 'back/shop-list.php';
require_once 'back/footer.php';
require_once 'back/users.php';
require_once 'back/page-settings.php';

$page_title = "Вход | СарNсскуство";

$reg = isset($_GET["reg"]);
$logout = isset($_GET["logout"]);

$isError = false;
$errType = "success";
$errName = "Error";
$errText = "Login error!";
$username = "";

if($logout){
    saveHeaders(0, 0, true);
    header("Location: index.php");
    die();
}

if($_POST['type']){
    if($_POST['type'] == "reg"){
        $r = register($_POST['mail'], $_POST['name'], $_POST['password']);
        if($r == -1){
            $reg = true;
            $isError = true;
            $errType = "danger";
            $errName = "Ошибка!";
            $errText = "Произошла ошибка сервера, попробуйте еще раз.";
        }else if($r == -2){
            $reg = true;
            $isError = true;
            $errType = "danger";
            $errName = "Ошибка!";
            $errText = "Пользователь с такой почтой уже существует.";
        }else{
            $reg = false;
            $isError = true;
            $errType = "success";
            $errName = "Удачно!";
            $errText = "Теперь, войдите в свой аккаунт.";
        }
    } else {
        $r = login($_POST['mail'], $_POST['password']);
        if($r == -1){
            $reg = false;
            $isError = true;
            $errType = "danger";
            $errName = "Ошибка!";
            $errText = "Пользователь не найден.";
        }else {
            saveHeaders($r, true, false);
            header("Location: index.php");
            die();
        }
    }
}

if(isLogined()){
    $r = getUser($_SESSION['id']);
    if($r) {
        $username = $r["name"] . $_SESSION['id'];
    }else{
        $reg = false;
        $isError = true;
        $errType = "danger";
        $errName = "Ошибка!";
        $errText = "Пользователь не найден.";
    }
}

?>

<html>

<head>
    <? renderHeader(); ?>
    <link rel="stylesheet" href="css/login.css" />
</head>

<body >

    <? renderTop();?>

    <div class="wrapper">
        <form class="form-signin" method="post">

            <? if($isError) { ?>
                <div class="alert alert-<?=$errType?>" role="alert">
                    <strong><?=$errName?></strong> <?=$errText?>
                </div>
            <? } ?>

            <?
            if(!isLogined()){
                if($reg){ ?>

                    <h2 class="form-signin-heading">Регистрация</h2>
                    <input type="hidden" name="type" value="reg" />
                    <input type="email" class="form-control" name="mail" placeholder="Почта" required="" autofocus="" />
                    <input type="text" class="form-control" name="name" placeholder="Имя" required="" autofocus="" />
                    <input type="password" class="form-control" name="password" placeholder="Пароль" required=""/>
                    <button class="btn btn-lg btn-success btn-block" type="submit">Регистрация</button>

                <? } else { ?>

                    <h2 class="form-signin-heading">Вход</h2>
                    <input type="hidden" name="type" value="log" />
                    <input type="email" class="form-control" name="mail" placeholder="Почта" required="" autofocus="" />
                    <input type="password" class="form-control" name="password" placeholder="Пароль" required=""/>
                    <button class="btn btn-lg btn-success btn-block" type="submit">Войти</button>
                <? } ?>
            <?} else {?>
                <h2 class="form-signin-heading text-center"><?=$username?></h2>
                <a href="login.php?logout" class="btn btn-lg btn-success btn-block" type="submit">Выйти</a>

            <?}?>
        </form>
    </div>


</body>

</html>
