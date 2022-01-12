<?php
$file = file('rule.txt');
$regex = '/[a-zA-Z]\\s[0-9]+\\.[0-9]+\\.[0-9]+\\s/i';
$regex2 = '/[0-9]+\\sof\\s133/i';
$html = "";
for($i=0;$i < count($file); $i++){
	if(strlen($file[$i])>6 && !preg_match($regex2,$file[$i]) && $file[$i][0] != "" && !str_contains($file[$i],". . .") && !str_contains($file[$i],"Formula Student Rules 2022")&& !str_contains($file[$i],"Version:")){
		if(preg_match($regex,substr($file[$i],0,12))){
			$html .= "<br>";
		}
		$html .= $file[$i];
		if(preg_match($regex,substr($file[$i],0,12))){
			$html .= "<br>";
		}
	}
}
echo $html;
?>