<?php
//init pdo and classes
require('2/init.php');

//document
//document/1



switch ($addition) {
    case 'list':
        $quary = new DocumentHandle($pdo);
        $data['documents'] = $quary->getList();
        break;
    case 'all':
        $quary = new DocumentHandle($pdo);
        $data['documents'] = $quary->getListAll();
        break;
    case 'quiz':
        $quary = new DocumentHandle($pdo);
        $data['documents'] = $quary->getListByQuizID($quiz_id);
        break;
    case 'single':
        $quary = new DocumentHandle($pdo);
        $data = $quary->getByID($document_id);
        break;
}
if(isset($data) && $data != null){

}else{
    $status = 204;
}
require('2/print.php');
?>