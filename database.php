<?php

$database = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);

if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

$database->select_db(DB_DATABASE);