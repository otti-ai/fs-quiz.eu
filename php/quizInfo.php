<?php
header('Content-Type: text/html; charset=utf-8');
//Diese Skript stelt Informationen aus dem Quiz zur verfuegung

//PDO Einbindung
include('datenbank.php');

//Anzahl der Fragen
$engine = $_GET['engine'];

if($engine == "c"){
	$sql = "SELECT COUNT(`eventID`) FROM `fsQuizQuestion` WHERE `eventID` = ? AND `combustion` = 1";
	$sql1 = "SELECT SUM(CASE WHEN `time` = '0' THEN '300' ELSE `time` END) FROM `fsQuizQuestion` WHERE `eventID` = ? AND `combustion` = 1";
}else{
	$sql = "SELECT COUNT(`eventID`) FROM `fsQuizQuestion` WHERE `eventID` = ? AND `electric` = 1";
	$sql1 = "SELECT SUM(CASE WHEN `time` = '0' THEN '300' ELSE `time` END) FROM `fsQuizQuestion` WHERE `eventID` = ? AND `electric` = 1";
}

$statement = $pdo->prepare($sql);
$statement->execute(array($_GET['event'])); 
$row = $statement->fetch();
echo $row[0];
echo ";";

$statement1 = $pdo->prepare($sql1);
$statement1->execute(array($_GET['event'])); 
$row1 = $statement1->fetch();
echo $row1[0];
echo ";";
?>