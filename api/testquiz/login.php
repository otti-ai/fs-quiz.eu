<?php
$result = "error";
require($_SERVER['DOCUMENT_ROOT']. '/datenbank.php');
$passwort = $_GET['passwort'];
$statement = $pdo->prepare("SELECT * FROM `fs-testquiz-user` WHERE `email` = ?");
$statement->execute(array($_GET["email"]));
$user = $statement->fetch();
if ($user !== false && password_verify($passwort, $user['passwort'])) {
    $result = $user['token'];
}
echo $result;
?>