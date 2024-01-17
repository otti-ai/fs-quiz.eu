<?php
header("Access-Control-Allow-Origin: *");
require($_SERVER['DOCUMENT_ROOT']. '/orginal_db.php');
$token = random_bytes(8);
$statement = $pdo->prepare("INSERT INTO `fs-testquiz-user` (`token`, `teamname`, `email`, `passwort`) VALUES (?, ?, ?, ?)");
$statement->execute(array($token, $_GET["teamname"], $_GET["email"],$_GET["passwort"]));
echo "ok";
?>