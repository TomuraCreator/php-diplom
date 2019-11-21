<?php 
include "autoload.php";

$post = $_POST;
$get = $_GET;
$auth = new Auth($post);

if($_GET['name'] === 'login') {
    if($auth->isLogin()) {
        var_dump("Пользователь верный"); // здесь будет перенаправление на страницу ЛК(нужно будет учитывать кто заходит переводчик или заказчик)
    } else {
        header("Location: login.php");
    }
} elseif($_GET['name'] === 'register') {
    $user = new User($post);
    if($auth->findLogin()) {
        header("Location: index.php?is_user=true");
    } else {
        $user->saveUser();
        //здесь будет перенаправление на страницу ЛК(нужно будет учитывать кто заходит переводчик или заказчик)
    }
}   
