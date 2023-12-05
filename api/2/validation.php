<?php 
require('2/orginal_db.php');

 //Statistic
 $sqlStatistic = "INSERT INTO `fs-statistic-api` (`apikey`, `request`) VALUES (?, ?)";
 $statementStatistic = $pdo->prepare($sqlStatistic);
 $statementStatistic->execute(array($api_key,$_SERVER['REQUEST_URI']));
?>