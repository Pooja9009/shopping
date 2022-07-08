<?php
require_once('db_fns.php');

function login($username, $password): int
{
    // check username and password with db
    // if yes, return true
    // else return false
    $conn = db_connect();
    // check if username is unique
    $result = $conn->query("select * from admin WHERE 
username = '".$username."' and password = sha1('".$password."')");
    if(!$result) {
        return 0;
    }

    if($result->num_rows > 0) {
        return 1;
    }

    return 0;

}

function check_admin_user(): bool
{
    // see if somebody is logged in and notify them if not
    if(isset($_SESSION['admin_user'])) {
        return true;
    }

    return false;
}

