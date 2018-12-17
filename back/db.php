<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "phpshop";

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
    (SELECT `name` FROM `category` WHERE `id` = `category_id`) AS category,
    (SELECT `name` FROM `genre` WHERE `id` = `genre_id`) AS genre,
    (SELECT `name` FROM `style` WHERE `id` = `style_id`) AS style,
    (SELECT `name` FROM `material` WHERE `id` = `material_id`) AS material,
    (SELECT `name` FROM `size` WHERE `id` = `size_id`) AS size,
    (SELECT `name` FROM `author` WHERE `id` = `author_id`) AS author
    FROM `items` WHERE `id` = $id 
    ");

    if($result){
        $rows = [];
        while($row = mysql_fetch_assoc($result)){
            $row['tags'] = $row['category'] . " / " . $row['style'] . " / " . $row['genre'] . " / " . $row['material']. " / " . $row['size'] ;
            $rows[] = $row;
        }
        return $rows;
    }

    return 0;
}

function getItemImages($id){
    $result = mysql_query("
    SELECT 
    `id`,
    `url`
    FROM `item_image` WHERE `item_id` = $id 
    ");

    if($result){
        $rows = [];
        while($rows[] = mysql_fetch_assoc($result));
        array_pop($rows);
        return $rows;
    }

    return 0;
}
