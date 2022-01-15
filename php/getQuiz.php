<?php
header('Content-Type: text/html; charset=utf-8');
//Diese Skript stelt eine Frage aus der Datenbank bereit

//PDO include
include('datenbank.php');

$engine = $_GET['engine'];
$event = $_GET['event'];

if($engine == "c"){
	$sql = "SELECT * FROM `fsQuizQuestion` WHERE `eventID` = ? AND `combustion` = 1";
}else{
	$sql = "SELECT * FROM `fsQuizQuestion` WHERE `eventID` = ? AND `electric` = 1";
}
$statement = $pdo->prepare($sql);
$statement->execute(array($event));
$string = "";
$i = 0;
foreach($statement as $row){
	//question
	$html = "";
	$html .= '<div class="question" data-typ="'.$row['typ'].'" id="quest'.$i.'" style="display: none;">';
	$html .= '<p>'.$row['question'].'</p>';
	if($row['img']>0){
		$html .= "<div class='container'><div class='row'><div class='col'><img class='mx-auto d-block img-fluid' src='/img/".$event."/".$row['img'].".jpg'></div></div></div>";
	}
	$html .= '<hr class="col-3 col-md-2">';
	//answer
	$sql2 = "SELECT `rigth`,`answer` FROM `fsQuizAnswers` WHERE `questionID` = ?";
	$statement2 = $pdo->prepare($sql2);
	$statement2->execute(array($row['ID'])); 
	switch ($row['typ']) {
		case "multi":
			$c = 0;
			foreach ($statement2 as $ans) {
				$html .= '<div class="form-check"><input class="form-check-input" type="checkbox" name="answer'.$c.'" id="answer'.$c.'" value="'.$ans[0];
				$html .= '" ans="'.$ans[1].'"><label id="ansText" class="form-check-label" for="answer'.$c.'">'.$ans[1].'</label></div>';
				$c++;
			}
			break;
		case "normal":
			$c = 0;
			foreach ($statement2 as $ans) {
				$html .= '<div class="form-check"><input class="form-check-input" type="radio" name="answer'.$c.'" id="answer'.$c.'" value="'.$ans[0];
				$html .= '" ans="'.$ans[1].'"><label id="ansText" class="form-check-label" for="answer'.$c.'">'.$ans[1].'</label></div>';
				$c++;
			}
			break;
		default:
			$ans = $statement2->fetch();
			$html .= '<input answer="'.$ans[1].'" type="text" anwser="'.$ans[0].'" class="form-control" id="numberInput'.$c.'" placeholder="Enter answer">';
			break;
	}
	$html .= '<hr class="col-3 col-md-2">';
	$html .= '<p id="timeText'.$i.'" style="display: none;">'.$row['time'].'</p></div>';
	$i++;
	
	
	
	$string .= $html."";
}
echo $string;
?>