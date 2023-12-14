<?php
header("Access-Control-Allow-Origin: *");

//PDO
require('2/orginal_db.php');
//Klassen
require("2/class/answer.php");
require("2/class/db_orginal.php");
require("2/class/document.php");
require("2/class/event.php");
require("2/class/image.php");
require("2/class/last-qualifier.php");
require("2/class/question.php");
require("2/class/questionQuiz.php");
require("2/class/quiz.php");
require("2/class/solution.php");
require("2/class/status.php");
require("2/class/statistic.php");

 //Statistic
 //$sqlStatistic = "INSERT INTO `fs-statistic-api` (`request`) VALUES (?)";
 //$statementStatistic = $pdoStatistic->prepare($sqlStatistic);
 //$statementStatistic->execute(array('v2',$_SERVER['REQUEST_URI']));
?>