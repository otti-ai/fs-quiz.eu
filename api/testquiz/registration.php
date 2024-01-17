<?php
require($_SERVER['DOCUMENT_ROOT']. '/datenbank.php');
$token = bin2hex(random_bytes(8));
$passwort_hash = password_hash($_GET["passwort"], PASSWORD_DEFAULT);
$statement = $pdo->prepare("INSERT INTO `fs-testquiz-user` (`token`, `teamname`, `email`, `passwort`) VALUES (?, ?, ?, ?)");
$statement->execute(array($token, $_GET["teamname"], $_GET["email"], $passwort_hash));
echo "ok";
?>