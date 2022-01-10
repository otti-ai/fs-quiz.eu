<?php
header('Content-Type: text/html; charset=utf-8');
//Diese Skript stelt die Dokumente zur verfuegung

$string = "";
$year = $_GET['y'];
$event = $_GET['e'];
$directories = scandir("../doc/");

foreach($directories as $d){
	if (!($d == '.') && !($d == '..')) {
		if($year=="q" && $event!="q"){
			$pos = strpos($d, $event);
			if ($pos !== false) {
				foreach(scandir("../doc/".$d) as $item){
					if (!($item == '.') && !($item == '..')) {
						$string .= "<a target='_blank' href='../doc/".$d."/".$item."'>".$item."</a>;";
					}
				}
			}
		}
		if($year!="q" && $event=="q"){
			$pos = strpos($d, $year);
			if ($pos !== false) {
				foreach(scandir("../doc/".$d) as $item){
					if (!($item == '.') && !($item == '..')) {
						$string .= "<a target='_blank' href='../doc/".$d."/".$item."'>".$item."</a>;";
					}
				}
			}
		}
		if($year!="q" && $event!="q"){
			$pos = strpos($d, $event.$year);
			if ($pos !== false) {
				foreach(scandir("../doc/".$d) as $item){
					if (!($item == '.') && !($item == '..')) {
						$string .= "<a target='_blank' href='../doc/".$d."/".$item."'>".$item."</a>;";
					}
				}
			}
			if ($d == $year) {
				foreach(scandir("../doc/".$year) as $item){
					if (!($item == '.') && !($item == '..')) {
						$string .= "<a target='_blank' href='../doc/".$year."/".$item."'>".$item."</a>;";
					}
				}
			}
		}
		if($year=="q" && $event=="q"){
			foreach(scandir("../doc/".$d) as $item){
				if (!($item == '.') && !($item == '..')) {
					$string .= "<a target='_blank' href='../doc/".$d."/".$item."'>".$item."</a>;";
				}
			}
		}
	}
}
echo substr($string, 0, -2);
?>