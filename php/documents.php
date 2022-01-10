<?php
header('Content-Type: text/html; charset=utf-8');
//Diese Skript stelt die Dokumente zur verfuegung
$dir = '../doc/'.$_GET['event'];
$dir2 = '../doc/'.$_GET['year'];
$string = "";
foreach(scandir($dir) as $item){
    if (!($item == '.')) {
        if (!($item == '..')) {
              $string .= "<a target='_blank' href='../../".$dir."/".$item."'>".$item."</a>;";
}}}
foreach(scandir($dir2) as $item2){
    if (!($item2 == '.')) {
        if (!($item2 == '..')) {
              $string .= "<a target='_blank' href='../../".$dir2."/".$item2."'>".$item2."</a>;";
}}}
echo substr($string, 0, -2);
?>