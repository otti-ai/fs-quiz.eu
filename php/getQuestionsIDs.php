<?php
header('Content-Type: text/html; charset=utf-8');
//Diese Skript stelt eine Frage aus der Datenbank bereit

//PDO Einbindung
include('datenbank.php');

//Fragen vom Quiz
$engine = $_GET['engine'];

if($engine == "c"){
	$sql = "SELECT `ID`, `time` FROM `fsQuizQuestion` WHERE `eventID` = ? AND `combustion` = 1";
}else{
	$sql = "SELECT `ID`, `time` FROM `fsQuizQuestion` WHERE `eventID` = ? AND `electric` = 1";
}
$statement = $pdo->prepare($sql);
$statement->execute(array($_GET['event']));
$string = "";
foreach($statement as $row){
	$string .= $row[0]."@".$row[1].";";
}
echo substr($string,0,-1);
?>