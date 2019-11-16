<?php
$mysqli = new mysqli('localhost', 'root', '', 'test_data');

$mysqli->query("INSERT INTO `cityes` VALUES(NULL, 'Красноярск', 1, 1)");