<?php
//init pdo and classes
require('2/init.php');

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