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
require("1/class/questionQuiz.php");
//questions
//questions/1
//questions/1/info
//questions/1/answer
//questions/1/img



switch ($addition) {
    case 'list':
        $quary = new QuestionHandle($pdo);
        $data['questions'] = $quary->getList();
        break;
    case 'all':
        $quary = new QuestionHandle($pdo);
        $data['questions'] = $quary->getListAll();
        break;
    case 'single':
        $quary = new QuestionHandle($pdo);
        $data = $quary->getByIDFull($question_id);
        break;
    case 'info':
        $quary = new QuestionHandle($pdo);
        $data = $quary->getByIDDetails($question_id);
        break;
    case 'answer':
        $quary = new AnswerHandle($pdo);
        $data['answers'] = $quary->getByQuestionID($question_id);
        break;
    case 'img':
        $quary = new ImageHandle($pdo);
        $data['images'] = $quary->getByAllQuestionID($question_id);
        break;
}
if(isset($data) && $data != null){

}else{
    $status = 204;
}
require('1/print.php');
?>