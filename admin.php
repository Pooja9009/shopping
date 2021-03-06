<?php
//require_once keyword is used to embed PHP code from another file
require_once('book_sc_fns.php');
session_start();

//$_POST is used to collect form data after submitting an HTML form with method="post"
if(@$_POST['username'] && @$_POST['passwd']) { //@ will supress your warning message
    // they have just tried logging in
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    if(login($username, $passwd)) {
        $_SESSION['admin_user'] = $username;
    } else {
        // unsuccessful login
        do_html_header('Problem: ');
        echo '<p>You could not be logged in. <br>
        You must be logged in to view this page.</p>';
        do_html_url('login.php', 'Login');
        do_html_footer();
        exit;
    }
}

do_html_header('Administration');
if(check_admin_user()) {
    display_admin_menu();
} else {
    echo '<p>You are not authorized to enter the administration area.</p>';
}

do_html_footer();