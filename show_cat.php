<?php
//include keyword is used to embed PHP
// code from another file.
include('book_sc_fns.php');

// The shopping cart needs sessions, so start one
session_start(); //Start new or resume existing session

//$_GET used to collect form data after submitting an HTML form with method="get".
$catid = $_GET['catid'];
$name = get_category_name($catid);

do_html_header($name);

$book_array = get_books($catid);
display_books($book_array);

// if logged in as admin, show add, delete book links
//isset — Determine if a variable is declared and is different than null
//$_SESSION used to set and get session variable values
if(isset($_SESSION['admin_user'])) {
    display_button('index.php', 'continue', 'Continue Shopping');
    display_button('admin.php', 'admin-menu', 'Admin Menu');
    display_button('edit_category_form?catid='.$catid, 'edit-category', 'Edit Category');
} else {
    display_button('index.php', 'continue-shopping', 'Continue Shopping');
}

do_html_footer();