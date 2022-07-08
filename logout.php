<?php


session_start();
session_destroy();
unset($_SESSION['username'], $_SESSION['passwd']);

header("location:index.php");

