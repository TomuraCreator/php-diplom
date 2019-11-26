<?php 
include "autoload.php";
    
$post = $_POST;

$order = new Order($post);

if($order->setTextComplete()) {
}   
