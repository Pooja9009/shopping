<?php
function calculate_shipping_cost(): float
{
    // as we are shipping products all over the world
    return 20.00;
}

function get_categories() {
    $conn= db_connect();
    $query = "select catid, catname from categories;";
    $result = @$conn->query($query);
    if(!$result) {
        return false;
    }
    $num_cats = @$result->num_rows;
    if($num_cats === 0) {
        return false;
    }
    return db_result_to_array($result);
}

// 将一个目录标识符转换为一个目录名
function get_category_name($catid): bool
{
    $conn = db_connect();
    $query = "select catname from categories where catid = '".$catid."'";
    $result = @$conn->query($query);
    if(!$result) {
        return false;
    }
    $num_cats = @$result->num_rows;
    if($num_cats === 0) {
        return false;
    }
    return $result->fetch_object()->catname;
}

function get_books($catid) {
    // query database for the books in a category
    if((!$catid)) {
        return false;
    }
    $conn = db_connect();
    $query = "select * from books where catid = '".$catid."'";
    $result = @$conn->query($query);
    if(!$result) {
        return false;
    }
    return db_result_to_array($result);
}

function get_book_details($isbn) {
    // query database for all details for a particular book
    if((!$isbn)) {
        return false;
    }
    $conn = db_connect();
    $query = "select * from books where isbn='".$isbn."'";
    $result = @$conn->query($query);
    if(!$result) {
        return false;
    }
    return @$result->fetch_assoc();
}

function calculate_price($cart) {
    // sum total price for all items in shopping cart
    $price = 0.0;
    if(is_array($cart)) {
        $conn = db_connect();
        foreach($cart as $isbn=>$qty) {
            $query = "select price from books where isbn = '".$isbn."'";
            $result = $conn->query($query);
            if($result) {
                $item = $result->fetch_object();
                $item_price = $item->price;
                $price += $item_price*$qty;
            }
        }
    }
    return $price;
}

function calculate_items($cart) {
    // sum total items in shopping cart
    $items = 0;
    if(is_array($cart)) {
        foreach($cart as $isbn=>$qty) {
            $items += $qty;
        }
    }
    return $items;
}