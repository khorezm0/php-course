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
    $res = mysql_query("SELECT * FROM size");
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

?>