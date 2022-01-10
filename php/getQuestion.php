<?php
header('Content-Type: text/html; charset=utf-8');
//Diese Skript stelt eine Frage aus der Datenbank bereit

//PDO Einbindung
include('datenbank.php');

$sql = "SELECT `question`,`typ`,`img`,`time`,`eventID` FROM `fsQuizQuestion` WHERE `ID` = ?";
$statement = $pdo->prepare($sql);
$statement->execute(array($_GET['id'])); 
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