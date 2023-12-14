<?php
session_start();
$sid = session_id();
$site = $_SERVER['REQUEST_URI'];
$ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$sql = "INSERT INTO `fs-statistic-error` (`site`, `ref`, `sessionID`) VALUES (?, ?, ?)";
$statement = $pdo->prepare($sql);
$statement->execute(array($site,$ref,$sid));
?>