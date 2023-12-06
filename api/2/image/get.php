<?php
//init pdo and classes
require('2/init.php');

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