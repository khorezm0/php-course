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
        while($rows[] = mysqli_fetch_assoc($result));
        array_pop($rows);  // pop the last row off, which is an empty row
        return $rows;
    }

    return 0;
}

?>