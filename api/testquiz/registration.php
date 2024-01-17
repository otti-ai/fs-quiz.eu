<?php
require($_SERVER['DOCUMENT_ROOT']. '/testquiz/datenbank.php');
$token = bin2hex(random_bytes(8));
$result = "error";
$passwort_hash = password_hash($_GET["passwort"], PASSWORD_DEFAULT);
$statement = $pdo->prepare("INSERT INTO `fs-testquiz-user` (`token`, `teamname`, `email`, `passwort`) VALUES (?, ?, ?, ?)");
try {
    $statement->execute(array($token, $_GET["teamname"], $_GET["email"], $passwort_hash));
    $result = "ok";
}
catch( PDOException $Exception ) {
    $result = "error";
}
echo $result;
?>