<?php

function parseGet($data)
{
    if($data) {
        return mysql_real_escape_string(htmlspecialchars($data));
    } else{
        return 0;
    }
}

function getAllCategories(){

}

?>