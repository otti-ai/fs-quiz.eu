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

//images
//images/1
//images/solution
//images/question

switch ($addition) {
    case 'list':
        $quary = new ImageHandle($pdo);
        $data['images'] = $quary->getList();
        break;
    case 'single':
        $quary = new ImageHandle($pdo);
        $data = $quary->getByID($image_id);
        break;
    case 'solution':
        $quary = new ImageHandle($pdo);
        $data['images'] = $quary->getSolutionList();
        break;
    case 'question':
        $quary = new ImageHandle($pdo);
        $data['images'] = $quary->getQuestionList();
        break;
}
if(isset($data) && $data != null){

}else{
    $status = 204;
}
require('1/print.php');
?>