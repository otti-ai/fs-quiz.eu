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
//email
$encoding = "utf-8";
$mail_subject = "info@fs-quiz.eu";
$mail_message = "Hello Team ".$_GET["teamname"].",\r\nthank you for registering for the fs-quiz.eu test quiz.\r\nThe quiz will take place on January 20th at 1pm. To participate you have to register at quiz.fs-quiz.eu before the quiz starts.\r\n\r\nWith kind regards\r\nYannik Ottens\r\n\r\nPS: Have fun with the quiz!";

$subject_preferences = array(
    "input-charset" => $encoding,
    "output-charset" => $encoding,
    "line-length" => 76,
    "line-break-chars" => "\r\n"
);

$header = "Content-type: text/html; charset=".$encoding." \r\n";
$header .= "From: fs-quiz.eu <info@fs-quiz.eu> \r\n";
$header .= "MIME-Version: 1.0 \r\n";
$header .= "Content-Transfer-Encoding: 8bit \r\n";
$header .= "Date: ".date("r (T)")." \r\n";
$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);

mail($_GET["email"], $mail_subject, $mail_message, $header);

echo $result;
?>