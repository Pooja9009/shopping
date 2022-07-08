<?php
//include keyword is used to embed PHP
// code from another file.
include('book_sc_fns.php');

// The shopping cart needs sessions, so start one
session_start(); //Start new or resume existing session

do_html_header('Welcome to Book-O-Rama');

echo '<p>Please choose a category:</p>';

$cat_array = get_categories();
display_categories($cat_array);

//$_SESSION used to set and get session variable values
//isset — Determine if a variable is declared and is different than null
if(isset($_SESSION['admin_user'])) {
    display_button('admin.php', 'admin-menu', 'Admin Menu');
}
do_html_footer();