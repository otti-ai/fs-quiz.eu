<?php
//init pdo and classes
require('2/init.php');
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