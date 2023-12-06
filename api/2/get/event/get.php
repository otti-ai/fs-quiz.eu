<?php
//init pdo and classes
require('2/init.php');

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
require('2/print.php');
?>