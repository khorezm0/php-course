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
    `size`,
    `style_id`,
    `author_id`,
    `genre_id`,
    (SELECT `name` FROM `category` WHERE `id` = `category_id`) AS category,
    (SELECT `name` FROM `genre` WHERE `id` = `genre_id`) AS genre,
    (SELECT `name` FROM `style` WHERE `id` = `style_id`) AS style,
    (SELECT `name` FROM `material` WHERE `id` = `material_id`) AS material,
    (SELECT `name` FROM `author` WHERE `id` = `author_id`) AS author,
    (SELECT `url` FROM `item_image` WHERE item_image.item_id = items.id AND `hidden`='0' LIMIT 1) AS image
    
    FROM `items` WHERE `id` = '$id'
    ");

    if($result){
        $row = mysql_fetch_assoc($result);
        $row['tags'] = $row['category'] . " / " . $row['style'] . " / " . $row['genre'] . " / " . $row['material']. " / " . $row['size'] ;
        return $row;
    }

    return 0;
}


function getItemsByCategory($cid,$max){
    if(!$max){
        $max = 100;
    }
    $result = mysql_query("
    SELECT 
    `id`,
    `name`,
    `price`,
    `category_id`,
    `style_id`,
    `material_id`,
    `size`,
    `style_id`,
    `author_id`,
    `genre_id`,
    (SELECT `name` FROM `category` WHERE `id` = `category_id`) AS category,
    (SELECT `name` FROM `genre` WHERE `id` = `genre_id`) AS genre,
    (SELECT `name` FROM `style` WHERE `id` = `style_id`) AS style,
    (SELECT `name` FROM `material` WHERE `id` = `material_id`) AS material,
    (SELECT `name` FROM `author` WHERE `id` = `author_id`) AS author,
    (SELECT `url` FROM `item_image` WHERE item_image.item_id = items.id AND `hidden`='0' LIMIT 1) AS image
    
    FROM `items` WHERE `category_id` = '$cid' LIMIT $max
    ");

    if($result){
        $arr = [];
        while ($row = mysql_fetch_assoc($result)){
            $row['tags'] = $row['category'] . " / " . $row['style'] . " / " . $row['genre'] . " / " . $row['material']. " / " . $row['size'] ;
            $arr[] = $row;
        }
        return $arr;
    }

    return 0;
}

function getItemsBySearch($tex,$max){
    if(!$max){
        $max = 100;
    }
    $result = mysql_query("
    SELECT 
    `id`,
    `name`,
    `price`,
    `category_id`,
    `style_id`,
    `material_id`,
    `size`,
    `style_id`,
    `author_id`,
    `genre_id`,
    (SELECT `name` FROM `category` WHERE `id` = `category_id`) AS category,
    (SELECT `name` FROM `genre` WHERE `id` = `genre_id`) AS genre,
    (SELECT `name` FROM `style` WHERE `id` = `style_id`) AS style,
    (SELECT `name` FROM `material` WHERE `id` = `material_id`) AS material,
    (SELECT `name` FROM `author` WHERE `id` = `author_id`) AS author,
    (SELECT `url` FROM `item_image` WHERE item_image.item_id = items.id AND `hidden`='0' LIMIT 1) AS image
    
    FROM `items` WHERE `name` LIKE '%$tex%' LIMIT $max
    ");

    if($result){
        $arr = [];
        while ($row = mysql_fetch_assoc($result)){
            $row['tags'] = $row['category'] . " / " . $row['style'] . " / " . $row['genre'] . " / " . $row['material']. " / " . $row['size'] ;
            $arr[] = $row;
        }
        return $arr;
    }

    return 0;
}

function getItemImages($id){
    $item = parseGet($id);
    $res = mysql_query("SELECT * FROM `item_image` WHERE `hidden` = 0 AND `item_id` = '$item'");
    return getArrByRes($res);
}
