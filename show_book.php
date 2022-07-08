<?php

//include keyword is used to embed PHP
// code from another file.
include('book_sc_fns.php');

// The shopping cart needs sessions, so start one
session_start();  //Start new or resume existing session

//$_GET used to collect form data after submitting an HTML form with method="get".
$isbn = $_GET['isbn'];

// get this book out of database
$book = get_book_details($isbn);
do_html_header(@$book['title']); //@ supress the waring message
display_book_details($book);

// set url for 'continue button'
$target = 'index.php';
if(@$book['catid']) { //@ supress the waring message
    $target = 'show_cat.php?catid='.$book['catid'];
}

// if logged in as admin, show edit book links
if(check_admin_user()) {
    display_button('edit_book_form.php?isbn='.$isbn, 'edit-item', 'Edit Item');
    display_button('admin.php', 'admin-menu', 'Admin Menu');
    display_button($target, 'continue', 'Continue');
} else {
    display_button('show_cart.php?new='.$isbn, 'add-to-cart', 'Add '.@$book['title']
        .' To My Shopping Cart'); //@ supress the waring message
    display_button($target, 'continue-shopping', 'Continue Shopping');
}

do_html_footer();