<?php

//include keyword is used to embed PHP
// code from another file.
include('book_sc_fns.php');

// The shopping cart needs sessions, so start one
session_start();  //Start new or resume existing session

//$_GET used to collect form data after submitting an HTML form with method="get".

@$new = $_GET['new'];  //@ supress the waring message

// 为购物车添加内容
if($new) {
    // new item selected
    //isset — Determine if a variable is declared and is different than null
    //$_SESSION used to set and get session variable values
    //$_POST used to collect form data after submitting an HTML form with method="post"
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
        $_SESSION['items'] = 0;
        $_SESSION['total_price'] = '0.00';
    }

    if(isset($_SESSION['cart'][$new])) {
        $_SESSION['cart'][$new]++;
    } else {
        $_SESSION['cart'][$new] = 1;
    }
    $_SESSION['total_price'] = calculate_price($_SESSION['cart']);
    $_SESSION['items'] = calculate_items($_SESSION['cart']);
}


if(isset($_POST['save'])) {
//   foreach used to create foreach loops, which loops through a block of code for each element in an array.
    foreach($_SESSION['cart'] as $isbn =>$qty) {

        if($_POST[$isbn] === '0') {
//            The unset() function unsets a variable.
            unset($_SESSION['cart'][$isbn]);
        } else {
            $_SESSION['cart'][$isbn] = $_POST[$isbn];
        }
    }
    //$_SESSION used to set and get session variable values
    $_SESSION['total_price'] = calculate_price($_SESSION['cart']);
    $_SESSION['items'] = calculate_items($_SESSION['cart']);
}

// 显示购物车
do_html_header('Your shopping cart');
echo '<br/>';

//$_SESSION used to set and get session variable values
//&&--------->True if both $x and $y are true
if(@$_SESSION['cart'] && array_count_values($_SESSION['cart'])) {
    if(isset($_POST['save'])) {
        display_cart($_SESSION['cart'], false, 0);
    } else {
        display_cart($_SESSION['cart'], true, 0);
    }
} else {
    echo "<p>There are no items in your cart</p><hr>";
}

$target = 'index.php';

// if we have just added an item to the cart, continue shopping in that category
if($new) {
    $details = get_book_details($new);
    if($details['catid']) {
        $target = 'show_cat.php?catid='.$details['catid'];
    }
}
display_button($target, 'continue-shopping', 'Continue Shopping');
display_button('checkout.php', 'go-to-checkout', 'Go To Checkout');

do_html_footer();