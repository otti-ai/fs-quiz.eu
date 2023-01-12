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

//solution
//solution/1
//solution/1/images


switch ($addition) {
    case 'list':
        $quary = new SolutionHandle($pdo);
        $data['solutions'] = $quary->getList();
        break;
    case 'single':
        $quary = new SolutionHandle($pdo);
        $data = $quary->getByID($solution_id);
        break;
    case 'img':
        $quary = new ImageHandle($pdo);
        $data['images'] = $quary->getByAllSolutionID($solution_id);
        break;
    case 'question':
        $quary = new SolutionHandle($pdo);
        $data['solutions'] = $quary->getListByQuestionID($question_id);
        break;
}
if(isset($data) && $data != null){

}else{
    $status = 204;
}
require('1/print.php');
?>