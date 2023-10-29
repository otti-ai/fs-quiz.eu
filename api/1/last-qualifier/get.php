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
require("1/class/last-qualifier.php");
require("1/class/db_orginal.php");

//last-qualifier
//last-qualifier/1

switch ($addition) {
    case 'list':
        $quary = new LastQualifierHandle($pdo);
        $data['last-qualifier'] = $quary->getList();
        break;
    case 'single':
        $quary = new LastQualifierHandle($pdo);
        $data = $quary->getByID($last_qualifier_id);
        break;
    case 'quiz':
        $quary = new LastQualifierHandle($pdo);
        $data = $quary->getListByQuizID($quiz_id);
        break;
}
if(isset($data) && $data != null){

}else{
    $status = 204;
}
require('1/print.php');
?>