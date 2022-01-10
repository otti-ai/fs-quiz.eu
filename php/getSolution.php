<?php
header('Content-Type: text/html; charset=utf-8');
//This script provides the solution to a question

//PDO
include('datenbank.php');

$sql = "SELECT `type`, `solution` FROM `fsQuizSolution` WHERE `questionID` = ?";
$statement = $pdo->prepare($sql);
$statement->execute(array($_GET['id']));
$string = "";
foreach($statement as $row){
	$string .= $row[0]."@".$row[1].";";
}
echo substr($string,0,-1);
?>