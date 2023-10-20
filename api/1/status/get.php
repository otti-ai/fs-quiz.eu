<?php
//PDO
require('1/orginal_db.php');
//Klassen
require("1/class/db_orginal.php");
require("1/class/systemStatus.php");

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