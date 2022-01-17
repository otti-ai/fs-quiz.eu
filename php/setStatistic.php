<?php
header('Content-Type: text/html; charset=utf-8');
//Diese Skript stelt eine Frage aus der Datenbank bereit

//PDO include
include('datenbank.php');

$id = $_GET['id'];
$count = $_GET['count'];

//statistic
$sql = "UPDATE `fsQuizStatistic` SET `count` = ? WHERE `fsQuizStatistic`.`ID` = ?";
$statement = $pdo->prepare($sql);
$statement->execute(array($count,$id));

?>