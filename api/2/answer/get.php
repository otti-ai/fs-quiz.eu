<?php
//Check API-KEY
require('1/validation.php');
//PDO
require('1/orginal_db.php');
//Klassen
require("1/class/event.php");
require("1/class/question.php");
require("1/class/document.php");
require("1/class/answer.php");
require("1/class/image.php");
require("1/class/solution.php");
require("1/class/quiz.php");
require("1/class/db_orginal.php");

//answer
//answer/1


switch ($addition) {
    case 'list':
        $quary = new AnswerHandle($pdo);
        $data['answers'] = $quary->getList();
        break;
    case 'single':
        $quary = new AnswerHandle($pdo);
        $data = $quary->getByID($answer_id);
        break;
}
if(isset($data) && $data != null){

}else{
    $status = 204;
}
require('1/print.php');
?>