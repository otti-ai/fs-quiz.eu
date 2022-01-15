<?php
header('Content-Type: text/html; charset=utf-8');
//This script searches the questions for the given parameters from the database.

//PDO include
require($_SERVER['DOCUMENT_ROOT']. '/php/datenbank.php');

$string = "";
$class = $_GET['class'];
$categories = explode("II",$_GET['category']);
foreach ($categories as $cate) {
   switch ($cate) {
    case "dynamic":
        $string = $string." AND c.dynamic = 1";
        break;
    case "electronic":
        $string = $string." AND c.electronic = 1";
        break;
    case "math":
        $string = $string." AND c.math = 1";
        break;
    case "mechanical":
        $string = $string." AND c.mechanical = 1";
        break;
    case "rule":
        $string = $string." AND c.rule = 1";
        break;
    case "scoring":
        $string = $string." AND c.scoring = 1";
        break;
    case "static":
        $string = $string." AND c.static = 1";
        break;
	}
}					
switch ($class) {
    case "e":
        $string = $string." AND q.electric = 1";
        break;
    case "c":
        $string = $string." AND q.combustion = 1";
        break;
}
if($_GET['img']>0){
    $string .= " AND q.img > 0" ;
}
$sql = "SELECT q.ID, q.question, q.eventID, q.img, q.electric, q.combustion FROM `fsQuizQuestion` q, `fsQuizCategory` c WHERE q.ID = c.questionID AND q.eventID LIKE ? ". $string;
$statement = $pdo->prepare($sql);
$statement->execute(array(str_replace("q","%",$_GET['event']))); 
$string = "";
foreach ($statement as $ro) {
        $string .= $ro[0]."@".$ro[1]."@".$ro[2]."@"."<img class='mx-auto d-block img-fluid' src='/img/".$ro[2]."/".$ro[3].".jpg'>";
        if($ro[4] == true && $ro[5] == true){
                $string .= "@Any;";
        }else if($ro[4] == true){
                $string .= "@EV;";
        }else{
                $string .= "@CV;";
        }
}
echo substr($string, 0, -1);
?>