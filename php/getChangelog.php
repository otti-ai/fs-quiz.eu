<?php
header('Content-Type: text/html; charset=utf-8');
//This script provides the changelog for the page

//PDO include
include('datenbank.php');

$typ = $_GET['type'];
$sql = "";
switch ($typ) {
    case 0:
        $sql = "SELECT `Date`,`Text` FROM `fsQuizChangelog` ORDER BY `Date` DESC LIMIT 5";
        break;
    case 1:
        $sql = "SELECT `Date`,`Text` FROM `fsQuizChangelog` WHERE `Quiz` = 1 ORDER BY `Date` DESC LIMIT 5";
        break;
    case 2:
        $sql = "SELECT `Date`,`Text` FROM `fsQuizChangelog` WHERE `Search` = 1 ORDER BY `Date` DESC LIMIT 5";
        break;
    default:
        $sql = "SELECT `Date`,`Text` FROM `fsQuizChangelog` ORDER BY `Date` DESC";
        break;
}

$statement = $pdo->prepare($sql);
$statement->execute(); 
$string = "";
foreach ($statement as $ro) {
   $string .= $ro[0].": ".$ro[1]."<br>";
}
echo substr($string, 0, -4);
?>