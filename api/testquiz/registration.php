<?php
include('datenbank.php');
$token = bin2hex(random_bytes(8));
$result = "error";
$passwort_hash = password_hash($_GET["passwort"], PASSWORD_DEFAULT);
$statement = $pdo->prepare("INSERT INTO `fs-testquiz-user` (`token`, `teamname`, `email`, `passwort`) VALUES (?, ?, ?, ?)");
try {
    $statement->execute(array($token, $_GET["teamname"], $_GET["email"], $passwort_hash));
    $result = "ok";
    $empfaenger = $_GET["email"];
    $betreff = "Registration for FS-Quiz Testquiz 2025";
    $from = "From: FS-Quiz<info@fs-quiz.eu>";
    $text = "Hello ".$_GET["teamname"].", \n\nYour registration for the FS-Quiz Testquiz 2025 has been successfully completed! The quiz will take place on January 24th at 16:00 CET on https://quiz.fs-quiz.eu. \n\nIf you have any issues, feel free to contact us at info@fs-quiz.eu.\n\nGood luck and have fun!\nThe FS-Quiz Team";
    
    mail($empfaenger, $betreff, $text, $from);
}
catch( PDOException $Exception ) {
    $result = "error";
}

echo $result;
?>