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
require("1/class/last-qualifier.php");
require("1/class/quiz.php");
require("1/class/db_orginal.php");
require("1/class/questionQuiz.php");
//quizzes
//quizzes/1
//quizzes/1/details
//quizzes/1/questions
//quizzes/1/documents

switch ($addition) {
    case 'list':
        $quary = new QuizHandle($pdo);
        $data['quizzes'] = $quary->getList();
        break;
    case 'single':
        $quary = new QuizHandle($pdo);
        $data = $quary->getByID($quiz_id);
        break;
    case 'details':
        $quary = new QuizHandle($pdo);
        $data = $quary->getDetailsByID($quiz_id);
        break;
    case 'questions':
        $quary = new QuestionHandle($pdo);
        $data['questions'] = $quary->getListByQuizIDFull($quiz_id);
        break;
    case 'documents':
        $quary = new DocumentHandle($pdo);
        $data['documents'] = $quary->getListByQuizID($quiz_id);
        break;
}
if(isset($data) && $data != null){

}else{
    $status = 204;
}
require('1/print.php');
?>