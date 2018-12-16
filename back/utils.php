<?php

function parseGet($data)
{
    return mysql_real_escape_string(htmlspecialchars($data));
}

?>