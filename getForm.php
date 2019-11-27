<?php

include 'autoload.php';

$get = $_GET;

echo 1;
exit(json_encode(JsonAction::getPersonParam($get['name'], JSON_UNESCAPED_UNICODE)));
// echo json_encode(JsonAction::getPersonParam($get['name']));