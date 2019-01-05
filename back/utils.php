<?php

function parseGet($data)
{
    if($data) {
        return mysql_real_escape_string(htmlspecialchars($data));
    } else{
        return 0;
    }
}
function getAuthors(){
    $res = mysql_query("SELECT * FROM author");
    return getArrByRes($res);
}

function getCategories(){
    $res = mysql_query("SELECT * FROM category");
    return getArrByRes($res);
}
function getGenres(){
    $res = mysql_query("SELECT * FROM genre");
    return getArrByRes($res);
}

function getMaterials(){
    $res = mysql_query("SELECT * FROM material");
    return getArrByRes($res);
}

function getStyles(){
    $res = mysql_query("SELECT * FROM style");
    return getArrByRes($res);
}
function getSizes(){
    $res = mysql_query("SELECT id, size FROM items GROUP BY size");
    return getArrByRes($res);
}

function getArrByRes($res){
    $arr = [];
    if($res){
        while ($arr[] = mysql_fetch_assoc($res));
        array_pop($arr);
    }
    return $arr;
}


function getPopulars(){
	
	$q = mysql_query("SELECT item_id FROM orders_items GROUP BY item_id ORDER BY item_id DESC");
	if($q){
		$cond = "";
		while($row = mysql_fetch_assoc($q)){
			if($cond != "") $cond .= ", ";
			$cond .= $row['item_id'];
		}
		if($cond != ""){
			$q = mysql_query("SELECT
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
			
			FROM `items` WHERE `id` IN ($cond) AND `hidden` = 0 ");
			
			return getArrByRes($q);
			
		}
	}
	return [];
}


function getNewItem(){
    $res = mysql_query("INSERT INTO items (hidden) VALUES (1)");
    if($res){
        $id = mysql_insert_id();
        $res = mysql_query("SELECT * FROM items WHERE `id` = $id");
        $arr = getArrByRes($res);
        if(count($arr) > 0)
            return $arr[0];
    }

    return [];
}

function updateItem($id, $name, $price, $category, $genre, $style, $size, $material, $hidden, $author){
    $q = mysql_query(
        "UPDATE `items` SET " .
        " `name` = '$name', " .
        " `price` = '$price', " .
        " `category_id` = '$category', " .
        " `genre_id` = '$genre', " .
        " `style_id` = '$style', " .
        " `size` = '$size', " .
        " `material_id` = '$material', " .
        " `author_id` = '$author', " .
        " `hidden` = '$hidden' " .
        " WHERE `id` = '$id'"
    );
    return $q;
}

function getBoundPrices(){
    $arr = [
        "min" => 0,
        "max" => 1000000
    ];
    $q = mysql_query("SELECT MAX(price) AS max, MIN(price) AS min FROM items");

    if($q){
        $row = mysql_fetch_assoc($q);
        $arr["min"] = $row['min'];
        $arr["max"] = $row['max'];
    }
    return $arr;
}

function extendedSearch($name, $categories, $genres, $styles, $materials, $authors, $sizes, $minPrice, $maxPrice){
    $catCond = getCond($categories);
    $genCond = getCond($genres);
    $stylCond = getCond($styles);
    $matCond = getCond($materials);
    $autCond = getCond($authors);
    $sizCond = getCond($sizes);

    $allcond = "";

    if($catCond){
       if($allcond == "") $allcond = " WHERE ";
       else $allcond .= " AND ";
       $allcond .= "category_id IN ($catCond)";
    }
    if($genCond){
        if($allcond == "") $allcond = " WHERE ";
        else $allcond .= " AND ";
        $allcond .= "genre_id IN ($genCond)";
    }
    if($stylCond){
        if($allcond == "") $allcond = " WHERE ";
        else $allcond .= " AND ";
        $allcond .= "style_id IN ($stylCond)";
    }
    if($matCond){
        if($allcond == "") $allcond = " WHERE ";
        else $allcond .= " ND ";
        $allcond .= "material_id IN ($matCond)";
    }
    if($autCond){
        if($allcond == "") $allcond = " WHERE ";
        else $allcond .= " AND ";
        $allcond .= "author_id IN ($autCond)";
    }
    if($sizCond){
        if($allcond == "") $allcond = " WHERE ";
        else $allcond .= " AND ";
        $allcond .= "size IN ($sizCond)";
    }
    if($name){
        if($allcond == "") $allcond = " WHERE ";
        else $allcond .= " AND ";
        $allcond .= "name LIKE '%$name%'";
    }
    if($minPrice){
        if($allcond == "") $allcond = " WHERE ";
        else $allcond .= " AND ";
        $allcond .= "price >= '$minPrice'";
    }
    if($maxPrice){
        if($allcond == "") $allcond = " WHERE ";
        else $allcond .= " AND ";
        $allcond .= "price <= '$maxPrice'";
    }

    $q = "
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
    
    FROM `items`
    $allcond
    ";

    $res = mysql_query($q);

    if($res){
        return getArrByRes($res);
    } else echo $q;

    return [];
}

function getCond($arr){
    $cond = "";
    if($arr && count($arr) > 0){
        foreach ($arr as $c => $val) {
            if($cond != "") $cond .= ", ";
            $cond .= "'$c'";
        }
    }
    return $cond;
}

function getCartSummary(){
    $arr = [];
    if($_SESSION['isUser']){
        $user = $_SESSION['id'];
        $res = mysql_query("SELECT SUM(count) as sum FROM cart WHERE user_id = '$user'");
        if($res){
            $arr['count'] = mysql_fetch_assoc($res)['sum'];
            $res = mysql_query("SELECT (SELECT price FROM items WHERE item_id = items.id) as price, count FROM cart WHERE user_id = '$user'");
            $totalSum = 0;
            if($res){
                while ($row = mysql_fetch_assoc($res)){
                    $totalSum += $row['count'] * $row['price'];
                }
                $arr['sum'] = $totalSum;
            }
        }
    }
    return $arr;
}

function getOrderStatusText($s){
    if($s == 0) return "В ожидании";
    if($s == 1) return "Проверка";
    if($s == 2) return "Отправка";
    if($s == 3) return "Завершена";
}

?>