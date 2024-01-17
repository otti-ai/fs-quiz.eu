<?php
header("Access-Control-Allow-Origin: *");

class Result{
    public $status;
    public $typ;
    public $question;
    public $answers;
    public $end;
}


$question1 = new DateTime('2024-01-20 13:00:00');
$question2 = new DateTime('2024-01-20 13:05:00');
$question3 = new DateTime('2024-01-20 13:10:00');

$now = new DateTime('now');
$result = new Result();
$result->status = "wait";
$result->end = $question1->getTimestamp();

if ($now > $question1) {
    $result->status = "1";
    $result->type = "single";
    $result->question = "1+1=?";
    $result->answers = array("1","2","3","4");
    $result->end = $question2->getTimestamp();
}
if ($now > $question2) {
    $result->status = "2";
    $result->type = "single";
    $result->question = "Hi";
    $result->answers = array("Moin","No","Hallo hallo");
    $result->end = $question3->getTimestamp();
}
echo json_encode($result);
?>