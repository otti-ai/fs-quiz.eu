<?php
header('Content-Type: text/html; charset=utf-8');
//Diese Skript stelt eine Frage aus der Datenbank bereit

//PDO Einbindung
include('datenbank.php');

//Fragen vom Quiz
$engine = $_GET['engine'];

if($engine == "c"){
	$sql = "SELECT `question`,`typ`,`img`,`ID`,`time` FROM `fsQuizQuestion` WHERE `eventID` = ? AND `number` = ? AND `combustion` = 1";
}else{
	$sql = "SELECT `question`,`typ`,`img`,`ID`,`time` FROM `fsQuizQuestion` WHERE `eventID` = ? AND `number` = ? AND `electric` = 1";
}
$statement = $pdo->prepare($sql);
	$statement->execute(array($_GET['event'],$_GET['number'])); 
$row = $statement->fetch();
echo $row[0];
echo ";";
echo $row[1];
echo ";";
echo $row[2];
echo ";";
echo $row[3];
echo ";";
echo $row[4];
?>