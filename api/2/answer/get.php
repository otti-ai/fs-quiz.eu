<?php
//init pdo and classes
require('2/init.php');

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