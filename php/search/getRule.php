<?php
header('Content-Type: text/html; charset=utf-8');
//This script get a rule from the database.

//PDO include
require($_SERVER['DOCUMENT_ROOT']. '/php/datenbank.php');

$id = $_GET['rule']."%";

//SELECT * FROM fsQuizRules WHERE ruleID NOT IN (SELECT r.ruleID FROM fsQuizRules r, fsQuizRulesVoided v WHERE r.ruleID LIKE CONCAT(v.voidRule,"%") AND v.ruleBook = "FSA22" AND v.voidBook = "FS2022") AND `rule` LIKE "%cars%" AND (`ruleBook` = "FS2022" OR `ruleBook` = "FSA22");
$sql = "SELECT * FROM fsQuizRules WHERE ruleID LIKE ?";
$statement = $pdo->prepare($sql);
$string = "";
$statement->execute(array($id)); 
foreach ($statement as $ro) {
        $string .= $ro[3];
        if($ro['img']>0){
                $string .= "<img class='mx-auto d-block img-fluid' src='/img/rule/".$ro[2]."/".$ro[5].".jpg'>";
        }
}
echo $string;
?>