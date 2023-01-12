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

//events
//events/1
//events/1/quizzes

switch ($addition) {
    case 'list':
        $quary = new EventHandle($pdo);
        $data['events'] = $quary->getListEvents();
        break;
    case 'single':
        $quary = new EventHandle($pdo);
        $data = $quary->getByID($event_id);
        break;
    case 'quizzes':
        $quary = new QuizHandle($pdo);
        $data['quizzes'] = $quary->getByEvents($event_id);
        break;
}
if(isset($data) && $data != null){

}else{
    $status = 204;
}
require('1/print.php');
?>