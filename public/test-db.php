<?php

require_once '../config/database.php';

$database = new database();
$conn = $database->connect();

if ($conn) {
    echo ("DataBase Connectd Successfully");
}
?>