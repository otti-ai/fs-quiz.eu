<?php
//init pdo and classes
require('2/init.php');

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