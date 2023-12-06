<?php
//init pdo and classes
require('2/init.php');

//Statistic
$sqlStatistic = "INSERT INTO `fs-statistic-api` (`apikey`, `request`) VALUES (?, ?)";
$statementStatistic = $pdo->prepare($sqlStatistic);
$statementStatistic->execute(array("null",$_SERVER['REQUEST_URI']));

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
require('1/print.php');
?>