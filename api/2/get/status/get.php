<?php
//init pdo and classes
require('2/init.php');

$addition = 'all';

switch ($addition) {
    case 'all':
        $quary = new SystemStatusHandle($pdo);
        $data = $quary->getAll();
        break;
}
if(isset($data) && $data != null){

}else{
    $status = 204;
}
require('2/print.php');
?>