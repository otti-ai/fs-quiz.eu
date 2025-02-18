<?php
//init pdo and classes
require('2/init.php');
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
require('2/print.php');
?>