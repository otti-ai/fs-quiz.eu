<?php
$startTime = new DateTime('2024-01-20 12:00:00');

$question1 = clone $startTime;
$question2 = clone $startTime->modify("+5 minutes");
$question3 = clone $startTime->modify("+5 minutes");
$question4 = clone $startTime->modify("+5 minutes");
$question5 = clone $startTime->modify("+7 minutes");
$question6 = clone $startTime->modify("+1 minutes");
$question7 = clone $startTime->modify("+1 minutes");
$question8 = clone $startTime->modify("+1 minutes");
$question9 = clone $startTime->modify("+20 minutes");
$question10 = clone $startTime->modify("+10 minutes");

$endTime = clone $startTime->modify("+3 minutes");
?>