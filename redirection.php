<?php 
include "autoload.php";

$post = $_POST;
$auth = new Auth($post);


// if($_GET['name'] === 'login') {
//     if($auth->isLogin()) {
//         var_dump("Пользователь верный");
//     } else {
//         // header("Location: wrong.php");
//     }
// } elseif($_GET['name'] === 'register') {
//     $user = new User($post);
//     if($auth->findLogin()) {
//         echo 'имя пользователя существует в нашей базе, используйте другое имя';
//     } else {
//         $user->saveUser();
//     }
// }   

var_dump(Password::getHashPassword('grtmfgewerGSDmcxhj1234', 2));
var_dump(Password::getHashPassword('1234', 2));
