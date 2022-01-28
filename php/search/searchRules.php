<?php
header('Content-Type: text/html; charset=utf-8');
//This script searches the rules for the given parameters from the database.

//PDO include
require($_SERVER['DOCUMENT_ROOT']. '/php/datenbank.php');

$year = $_GET['year'];
$event = $_GET['event'];
$text = "%".$_GET['text']."%";
$rule = $_GET['rule']."%";

//SELECT * FROM fsQuizRules WHERE ruleID NOT IN (SELECT r.ruleID FROM fsQuizRules r, fsQuizRulesVoided v WHERE r.ruleID LIKE CONCAT(v.voidRule,"%") AND v.ruleBook = "FSA22" AND v.voidBook = "FS2022") AND `rule` LIKE "%cars%" AND (`ruleBook` = "FS2022" OR `ruleBook` = "FSA22");
$sql = "SELECT * FROM fsQuizRules WHERE ruleID NOT IN (SELECT r.ruleID FROM fsQuizRules r, fsQuizRulesVoided v WHERE r.ruleID LIKE CONCAT(v.voidRule,'%') AND v.ruleBook = ? AND v.voidBook = ?) AND `rule` LIKE ? AND (`ruleBook` = ? OR `ruleBook` = ?) AND ruleID LIKE ?";
$statement = $pdo->prepare($sql);
$string = "";
$statement->execute(array($event, $year, $text, $event, $year, $rule)); 
foreach ($statement as $ro) {
        $string .= $ro[0]."@@".$ro[1]."@@".$ro[2]."@@".$ro[3];
        if($ro['img']>0){
                $string .= "<img class='mx-auto d-block img-fluid' src='/img/rule/".$ro[2]."/".$ro[5].".jpg'>";
        }
        $string .= "@@".$ro[4]."@@||";
}
echo substr($string, 0, -2);
?>