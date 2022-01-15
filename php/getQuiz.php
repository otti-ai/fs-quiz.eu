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
	$html .= '<div class="question" data-time="'.$row['time'].'" data-typ="'.$row['typ'].'" id="quest'.$i.'" style="display: none;"><h4 style="display: none;" id="questTitel'.$i.'">Question: '.($i+1).'</h4><div id="questText'.$i.'">';
	$html .= '<p>'.$row['question'].'</p>';
	if($row['img']>0){
		$html .= "<div class='container'><div class='row'><div class='col'><img class='mx-auto d-block img-fluid' src='/img/".$event."/".$row['img'].".jpg'></div></div></div>";
	}
	$html .= '</div><hr class="col-3 col-md-2">';
	//answer
	$sql2 = "SELECT `rigth`,`answer` FROM `fsQuizAnswers` WHERE `questionID` = ?";
	$statement2 = $pdo->prepare($sql2);
	$statement2->execute(array($row['ID'])); 
	switch ($row['typ']) {
		case "multi":
			$c = 0;
			foreach ($statement2 as $ans) {
				$html .= '<div class="form-check"><input class="form-check-input" type="checkbox" name="answer'.$i.'" id="answer'.$i.'" value="'.$ans[0];
				$html .= '" data-ans="'.$ans[1].'"><label id="ansText" class="form-check-label">'.$ans[1].'</label></div>';
				$c++;
			}
			break;
		case "normal":
			$c = 0;
			foreach ($statement2 as $ans) {
				$html .= '<div class="form-check"><input class="form-check-input" type="radio" name="answer'.$i.'" id="answer'.$i.'" value="'.$ans[0];
				$html .= '" data-ans="'.$ans[1].'"><label id="ansText" class="form-check-label">'.$ans[1].'</label></div>';
				$c++;
			}
			break;
		default:
			$ans = $statement2->fetch();
			$html .= '<input data-answer="'.$ans[1].'" type="text" class="form-control" id="numberInput'.$i.'" placeholder="Enter answer">';
			break;
	}
	$html .= '<hr class="col-3 col-md-2"></div>';
	$i++;
	
	
	
	$string .= $html."";
}
echo $string;
?>