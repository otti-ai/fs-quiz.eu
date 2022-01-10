<?php
header('Content-Type: text/html; charset=utf-8');
//Diese Skript stelt Informationen aus dem Quiz zur verfuegung

//PDO Einbindung
include('datenbank.php');
$string = "";
$class = $_GET['class'];
$categories = explode("II",$_GET['category']);
foreach ($categories as $cate) {
   switch ($cate) {
    case "dynamic":
        $string = $string." AND c.dynamic = 1";
        break;
    case "electronic":
        $string = $string." AND c.electronic = 1";
        break;
	case "math":
        $string = $string." AND c.math = 1";
        break;
	case "mechanical":
        $string = $string." AND c.mechanical = 1";
        break;
	case "rule":
        $string = $string." AND c.rule = 1";
        break;
	case "scoring":
        $string = $string." AND c.scoring = 1";
        break;
	case "static":
        $string = $string." AND c.static = 1";
        break;
	}
}					
switch ($class) {
    case "c":
        $string = $string." AND q.electric = 1";
        break;
    case "e":
        $string = $string." AND q.combustion = 1";
        break;
}
$sql = "SELECT q.ID FROM `fsQuizQuestion` q, `fsQuizCategory` c WHERE q.ID = c.questionID AND q.eventID LIKE ?". $string;
//Anzahl der Fragen
$statement = $pdo->prepare($sql);
$statement->execute(array(str_replace("q","%",$_GET['event']))); 
$string = "";
foreach ($statement as $ro) {
   $string .= $ro[0].";";
}
echo substr($string, 0, -1);

?>