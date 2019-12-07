<?php

include 'autoload.php';

$get = $_GET;

echo json_encode([
    "card" => JsonAction::getPersonParam($get['name'], 'card_order'),
    "text" => JsonAction::getPersonParam($get['name'], 'original_text')
], JSON_UNESCAPED_UNICODE);
exit();
