<?php 
include "autoload.php";

$post = $_POST;
$get = $_GET;
$auth = new Auth($post);

if($_GET['name'] === 'login') {
    if($auth->isLogin()) {
        var_dump("Пользователь верный"); 
        header("Location: body.php");
    } else {
        header("Location: login.php");
    }
} elseif($_GET['name'] === 'register') {
    $user = new User($post);
    if($auth->findLogin()) {
        header("Location: index.php?is_user=true");
    } else {
        $user->saveUser();
        header("Location: body.php");
    }
}   
