<?php
session_start();
if(!isset($_GET["pre"])){
    $sid = session_id();
    $site = $_SERVER['REQUEST_URI'];
    $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $sql = "INSERT INTO `fs-statistic-website` (`site`, `ref`, `sessionID`) VALUES (?, ?, ?)";
    $statement = $pdoStatistic->prepare($sql);
    $statement->execute(array("api".$site,$ref,$sid));
}
?>