<?php
header('Content-Type: text/html; charset=utf-8');
//Diese Skript stelt eine Frage aus der Datenbank bereit

//PDO Einbindung
include('datenbank.php');

//Fragen vom Quiz
$sql = "SELECT `rigth`,`answer` FROM `fsQuizAnswers` WHERE `questionID` = ?";
$statement = $pdo->prepare($sql);
$statement->execute(array($_GET['questionID'])); 
$string = "";
foreach ($statement as $ro) {
   $string .= $ro[1]."@".$ro[0]."||";
}
echo substr($string, 0, -2);
?>