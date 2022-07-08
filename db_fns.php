<?php
function db_connect(): mysqli
{
    $result = new mysqli('localhost', 'root', '', 'book_sc');
    // MySQL事务autocommit自动提交
    $result->autocommit(TRUE);
    return $result;
}

function db_result_to_array($result): array
{
    $res_array = array();

    for ($count = 0; $row = $result->fetch_assoc(); $count++) {
        $res_array[$count] = $row;
    }
    return $res_array;
}