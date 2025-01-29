<?php
$startTime = new DateTime('2025-01-24 15:00:00');

$question1 = clone $startTime;
$question2 = clone $startTime->modify("+1 minutes");
$question3 = clone $startTime->modify("+1 minutes");
$question4 = clone $startTime->modify("+1 minutes");
$question5 = clone $startTime->modify("+1 minutes");
$question6 = clone $startTime->modify("+1 minutes");
$question7 = clone $startTime->modify("+1 minutes");
$question8 = clone $startTime->modify("+1 minutes");
$question9 = clone $startTime->modify("+1 minutes");
$question10 = clone $startTime->modify("+1 minutes");

$endTime = clone $startTime->modify("+1 minutes");
?>