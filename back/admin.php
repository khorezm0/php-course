<?php

require_once 'header.php';
require_once 'db.php';
require_once 'users.php';
require_once 'utils.php';

if(!$_SESSION["isAdmin"]){
	header("Location: /coursephp/login.php?admin");
	die();
}

$createRow = parseGet($_GET["create"]);
$editRow = parseGet($_GET["edit"]);
$delRow = parseGet($_GET["del"]);
$value = parseGet(urldecode($_GET["value"]));

$editOrderStatus = parseGet($_GET["edit_item"]);


if($createRow && $value){
    $q = "INSERT INTO `$createRow` (`name`) VALUES ('$value')";
    $res = mysql_query($q);
    if($res){
        echo (mysql_insert_id());
    }else{
        echo 0;
    }
}
if($editRow && $value){
	$type = parseGet($_GET['type']);
	if(!$type){
		die(0);
	}
    $q = "UPDATE `$type` SET `name` = '$value' WHERE `id` = '$editRow'";
    $res = mysql_query($q);
    if($res){
        echo 1;
    }else{
        echo mysql_error();
    }
}
if($delRow){
	$type = parseGet($_GET['type']);
	if(!$type){
		die(0);
	}
    $q = "DELETE FROM `$type` WHERE `id` = '$delRow'";
    $res = mysql_query($q);
    if($res){
        echo 1;
    }else{
        echo mysql_error();
    }
}
if($editOrderStatus) {
    $val = parseGet($_GET['status']);
    if(!$val){
        die(0);
    }
    $q = "UPDATE `orders` SET `status` = '$val' WHERE `id` = '$editOrderStatus'";
    $res = mysql_query($q);
    if($res){
        echo 1;
    }else{
        echo mysql_error();
    }
}