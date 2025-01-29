<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
include('datenbank.php');
require('times.php');

$result = $_GET["result"];
$question = $_GET["question"];
$correct = 0;
$diffTime = 0;
$now = new DateTime('now');

switch ($question) {
    case 1:
        if(strcmp($result,'4640000, 1030') == 0){$correct = 1;}
        $diffTime = $now->getTimestamp() - $question1->getTimestamp();
        break;
    case 2:
        if(strcmp($result,'D') == 0){$correct = 1;}
        $diffTime = $now->getTimestamp() - $question2->getTimestamp();
        break;
    case 3:
        if(strcmp($result,'0.2923') == 0){$correct = 1;}
        $diffTime = $now->getTimestamp() - $question3->getTimestamp();
        break;
    case 4:
        if(strcmp($result,'B, E') == 0){$correct = 1;}
        $diffTime = $now->getTimestamp() - $question4->getTimestamp();
        break;
    case 5:
        if(strcmp($result,'A') == 0){$correct = 1;}
        $diffTime = $now->getTimestamp() - $question5->getTimestamp();
        break;
    case 6:
        if(strcmp($result,'C') == 0){$correct = 1;}
        $diffTime = $now->getTimestamp() - $question6->getTimestamp();
        break;
    case 7:
        if(strcmp($result,'B') == 0){$correct = 1;}
        $diffTime = $now->getTimestamp() - $question7->getTimestamp();
        break;
    case 8:
        if(strcmp($result,'-0.5') == 0){$correct = 1;}
        $diffTime = $now->getTimestamp() - $question8->getTimestamp();
        break;
    case 9:
        if(strcmp($result,'50.33') == 0){$correct = 1;}
        $diffTime = $now->getTimestamp() - $question9->getTimestamp();
        break;
    case 10:
        if(strcmp($result,'A, F, G, H, I, J') == 0){$correct = 1;}
        $diffTime = $now->getTimestamp() - $question10->getTimestamp();
        break;
}

$statement = $pdo->prepare("INSERT INTO `fs-testquiz-result` (`user_id`, `result`, `question_id`, `correct`, `time`) VALUES (?, ?, ?, ?, ?)");
$statement->execute(array($_GET["id"], $result, $question, $correct, $diffTime));
$result = "ok";


echo $result;
?>