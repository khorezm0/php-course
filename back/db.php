<?php

session_start();

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "artShop";

$__mysql_link = mysql_connect($db_host, $db_user, $db_password);
$__is_db_selected = mysql_select_db($db_name);


if(!$__mysql_link || !$__is_db_selected)
{
    echo("ERROR: " + mysql_error());
}

function getItem($id){
    $result = mysql_query("
    SELECT 
    `id`,
    `name`,
    `price`,
    `category_id`,
    `style_id`,
    `material_id`,
    `size_id`,
    `style_id`,
    `author_id`,
    `genre_id`,
    (SELECT `name` FROM `category` WHERE `id` = `category_id`) AS category,
    (SELECT `name` FROM `genre` WHERE `id` = `genre_id`) AS genre,
    (SELECT `name` FROM `style` WHERE `id` = `style_id`) AS style,
    (SELECT `name` FROM `material` WHERE `id` = `material_id`) AS material,
    (SELECT `name` FROM `size` WHERE `id` = `size_id`) AS size,
    (SELECT `name` FROM `author` WHERE `id` = `author_id`) AS author
    
    FROM `items` WHERE `id` = '$id'
    ");

    if($result){
        $row = mysql_fetch_assoc($result);
        $row['tags'] = $row['category'] . " / " . $row['style'] . " / " . $row['genre'] . " / " . $row['material']. " / " . $row['size'] ;
        return $row;
    }

    return 0;
}

function getItemImages($id){
    $item = parseGet($id);
    $res = mysql_query("SELECT * FROM item_image WHERE item_id = '$item'");
    return getArrByRes($res);
}
