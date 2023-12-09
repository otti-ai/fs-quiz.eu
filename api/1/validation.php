<?php
header("Access-Control-Allow-Origin: *");

require('1/orginal_db.php');
$statementLogin = $pdo->prepare("SELECT *  FROM `fs-api-user` WHERE `apikey` = :apikey");
$result = $statementLogin->execute(array('apikey' => $api_key));
$user = $statementLogin->fetch();
        
//Überprüfung des Keys
if (!$user) {
	$status = 401;
	require('print.php');
	exit;
}

//Checkt timeout
if ($user['is_limited']) {
	$statementLast = $pdo->prepare("SELECT * FROM `fs-statistic-api` WHERE `apikey` = :apikey ORDER BY `fs-statistic-api`.`time` DESC LIMIT 10, 1;");
	$result = $statementLast->execute(array('apikey' => $api_key));
	$used = $statementLast->fetch();
	if($used['time'] !== false){
		$now    = time();
		$target = strtotime($used['time']);
		$diff   = $now - $target;
		if($diff<60){
			$statement = $pdo->prepare("UPDATE `fs-api-user` SET `timeout` = CURRENT_TIMESTAMP() WHERE `apikey` = :apikey");
			$statement->execute(array('apikey' => $api_key));
			$status = 429;
			require('print.php');
			exit;
		}
	}
}
if (time()-strtotime($user['timeout'])<600) {
	$status = 429;
	require('print.php');
	exit;
}

 //Statistic
 $sqlStatistic = "INSERT INTO `fs-statistic-api` (`apikey`, `request`) VALUES (?, ?)";
 $statementStatistic = $pdo->prepare($sqlStatistic);
 $statementStatistic->execute(array($api_key,$_SERVER['REQUEST_URI']));
?>