<?php

require_once "db.php";
require_once "utils.php";

function login($_mail, $_passw){

    $mail = parseGet($_mail);
    $passw = parseGet($_passw);

    if($mail && $passw){

        $res = mysql_query("SELECT id FROM user WHERE mail = '$mail' AND password = '$passw'");
        if($res && ($u = mysql_fetch_assoc($res))){
            return $u["id"];
        }
    }

    return -1;
}


function register($_mail, $_name, $_passw){
    $mail = parseGet($_mail);
    $passw = parseGet($_passw);
    $name = parseGet($_name);
    if($mail && $passw && $name){
        $res = mysql_query("SELECT id FROM user WHERE mail = '$mail'");
        if($res && mysql_num_rows($res) <= 0){
            $res = mysql_query("INSERT INTO user (mail, name, password) VALUES ('$mail', '$name', '$passw')");
            if($res){
                return mysql_insert_id();
            }else{
                return -1;
            }
        }else{
            echo mysql_error();
            return -2;
        }
    }

    return -1;
}

function getUser($_id){

    $id = parseGet($_id);

    if($id){
        $res = mysql_query("SELECT id,name,mail FROM user WHERE id = $id");
        if($res && ($u = mysql_fetch_assoc($res))){
            return [
                "id" => $u["id"],
                "name" => $u["name"],
                "mail" => $u["mail"]
            ];
        }
    }

    return 0;
}

function saveHeaders($id, $isUser, $logout){
    if($logout){
        unset($_SESSION['isUser']);
        unset($_SESSION['id']);
    }
    else{
        $_SESSION['isUser'] = $isUser;
        $_SESSION['id'] = $id;
    }
}

function getCart(){
    $id = $_SESSION['id'];
    if($id){
        $res = mysql_query("
        SELECT 
        cart.id AS cartId,
        cart.item_id AS id,
        name,
        price,
        (SELECT `name` FROM `category` WHERE `id` = `category_id`) AS category,
        (SELECT `name` FROM `genre` WHERE `id` = `genre_id`) AS genre,
        (SELECT `name` FROM `style` WHERE `id` = `style_id`) AS style,
        (SELECT `name` FROM `material` WHERE `id` = `material_id`) AS material,
        (SELECT `name` FROM `size` WHERE `id` = `size_id`) AS size,
        (SELECT `name` FROM `author` WHERE `id` = `author_id`) AS author,
        (SELECT `url` FROM `item_image` WHERE item_image.item_id = cart.item_id LIMIT 1) AS image
        FROM `cart`
        INNER JOIN items ON items.id = cart.item_id
        WHERE cart.user_id = $id
        ");

        if($res){
            $cart = [];
            while ($row = mysql_fetch_assoc($res)){
                $row['tags'] = $row['category'] . " / " . $row['style'] . " / " . $row['genre'] . " / " . $row['material']. " / " . $row['size'] ;
                $cart[] = $row;
            }
            return $cart;
        }else{
            echo mysql_error();
        }
    }
    return 0;
}

function addCart($_item){
    $item = parseGet($_item);
    $user = $_SESSION["id"];
    if($item && $user){
        if(!isInCart($item, $user)){
            $res = mysql_query("INSERT INTO cart (user_id, item_id, count) VALUES ('$user', '$item', 1)");
            if($res){
                return mysql_insert_id();
            }else{
                return -1;
            }
        }else{
            echo mysql_error();
            return -2;
        }
    }

    return -1;
}

function isInCart($item, $user){
    $res = mysql_query("SELECT item_id FROM cart WHERE item_id = '$item' AND user_id = $user");
    if($res && mysql_num_rows($res) > 0){
        return true;
    }
    return false;
}

function remCart($_item){
    $item = parseGet($_item);
    $user = $_SESSION["id"];
    if($item && $user){
        $res = mysql_query("DELETE FROM cart WHERE item_id = '$item' AND user_id = $user;");
        if($res){
            return 1;
        }else{
            return 0;
        }
    }

    return 0;
}

function isLogined(){
    return isset($_SESSION['isUser']);
}

function getHash($data){
    if($data) return hash ("sha256",$data);
    else return 0;
}