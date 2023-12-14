<?php
//init pdo and classes
require('2/init.php');

//statistic   limit 14 days
//statistic/2023-12-12

//statistic/

switch ($addition) {
    case 'list':
        $quary = new StatisticHandle($pdo);
        $data['statistics'] = $quary->getList();
        break;
    case 'single':
        $quary = new StatisticHandle($pdo);
        $data = $quary->getByDate($date);
        break;
    case 'views':
        $quary = new StatisticHandle($pdo);
        $data['most_views'] = $quary->getListOfViewsByDate($date);
        break;
    case 'calls':
        $quary = new StatisticHandle($pdo);
        $data['most_calls'] = $quary->getListOfCallsByDate($date);
        break;
}
if(isset($data) && $data != null){

}else{
    $status = 204;
}
require('2/print.php');
?>