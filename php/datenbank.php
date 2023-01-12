<?php

define("USER_NAME", "root");
define("DATABASE", "api");
define("PASSWORD", "");
define("HOST", "localhost");
define("PORT", "3306");

$pdo = new PDO("mysql:host=".HOST.":".PORT.";dbname=".DATABASE, USER_NAME, PASSWORD);
?>