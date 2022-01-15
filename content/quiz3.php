<?php
$event = $_GET['event'];
$engine = "e";
$year = $_GET['year'];
$name = "";
switch ($event) {
    case "fsn":
        $name = "Netherland";
        break;
    case "fsa":
        $name = "Austria";
        break;
    case "fsg":
        $name = "Germany";
        break;
	case "fscz":
        $name = "Czech Republic";
        break;
	case "fsch":
        $name = "Switzerland";
        break;
	case "fseast":
        $name = "East";
        break;
	case "fss":
        $name = "Spain";
        break;
}
$version = substr($year,0,2);
if(strlen($year)>2){
	if (strpos($year, 't') !== FALSE){
		$version = $version." Test";
	}else{
		$version = $version.' V2';
	}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">
	<script src="/js/bootstrap.js"></script>
	
	<!-- Quiz -->
	<script src="/js/time2.js"></script>
	
    <title>FS-Quiz - Play</title>
  </head>
  <body onload="load()" class="d-flex flex-column min-vh-100"> 
	<header class="p-3 bg-dark text-white">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid col-lg-8">
				<a href='/home' class="navbar-brand" >FS-Quiz</a>
				<a class="navbar-brand" id="count"></a>
			</div>
		</nav>
	</header>
  
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
	<div id="divStart" style="display: block;">
		<h1>FS <?php echo $name; ?> Registration Quiz 20<?php echo $version ?></h1>
		<div class="row g-5">
		<div class="col-md-6">
			<h3>Infomation</h3>
			<p id="maxInfo" style="margin-bottom: 0;">Questions: x</p>
			<p id="timeInfo" style="margin-bottom: 0;">Time: x</p>
			<p id="classInfo" style="margin-bottom: 0;">Class: <?php echo strtoupper($engine); ?>V</p>
		</div>
		<div class="col-md-6">
			<h3>Settings</h3>
			<div class="form-floating">
					<select onchange="modusSwitch()" class="form-select" id="modusSelect" aria-label="modusSelect">
						<option value="0" selected>Single question</option>
						<option value="1">All questions</option>
					</select>
					<label for="categorySelect">Modus</label>
			</div>
			<div class="form-check form-switch">
				<input onclick="settings();" class="form-check-input" type="checkbox" id="settingTiming" checked>
				<label class="form-check-label" for="settingTiming">Timekeeping</label>
			</div>
			<div style="margin-left: 2rem;" class="form-check form-switch" id="settingSkipDiv">
				<input class="form-check-input" type="checkbox" id="settingSkip" checked>
				<label class="form-check-label" for="settingSkip">Allow skip time to next question</label>
			</div>
			<div style="margin-left: 2rem;" class="form-check form-switch" id="settingTimeEndDiv">
				<input class="form-check-input" type="checkbox" id="settingTimeEnd">
				<label class="form-check-label" for="settingTimeEnd">End question with expired time</label>
			</div>
			<!--<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" id="settingTiming" checked>
				<label class="form-check-label" for="settingTiming">Show participation prediction</label>
			</div>-->
			<div class="form-check form-switch" id="settingAutoNextDiv">
				<input class="form-check-input" type="checkbox" id="settingAutoNext" checked>
				<label class="form-check-label" for="settingAutoNext">Next question prompt</label>
			</div>
			<div class="form-check form-switch" style="display: none;" id="settingSubmitDiv">
				<input class="form-check-input" type="checkbox" id="settingSubmit" checked>
				<label class="form-check-label" for="settingSubmit">Multiple submission</label>
			</div>
		</div>
		</div>
		<div class="row g-5">
		<div class="col-md-6">
			<h3>Documents</h3>
			<ul  id="doc" class="icon-list">
			</ul>
		</div>
		<div class="col-md-6">
			<hr class="col-3 col-md-2">
			<div class="mb-5">
				<a onclick="start()"  class="btn btn-primary btn-lg px-4">Start</a>
			</div>
		</div>
		</div>
	</div>
	<div id="divResult" style="display: none;">
	</div>
	<div class="question" id="quest" style="display: none;">
		<p class="fs-5" id="questionText">Need a Question</p>
		<div class="" id="imgBox">
		</div>
		<hr class="col-3 col-md-2">
		<div id="answerBody">
			
		</div>
		<hr class="col-3 col-md-2">
		<p id="timeText" style="display: none;">600</p>
	</div>
	<div id="time" style="display: none;">
		<div class="row">
			<div class="col"></div>
			<div class="col text-center">
				<p class="fs-5" id="zeit"></p>
				<input id="next" style="display: none;" class="btn btn-primary" onclick="openQuestion()" type="submit" value="next">
			</div>
			<div id="submitbutton" class="col text-end">
				<input class="btn btn-primary" onclick="checkAnswerRadio()" type="submit" value="Submit">
			</div>
			<div id="nextbutton" class="col text-end" style="display: none;">
				<input class="btn btn-primary" onclick="openQuestion()" type="submit" value="Skip">
			</div>
		</div>
</div>
 
</div> 
  </main>
  <footer class="footer mt-auto bg-light">
  <div class="col-lg-8 mx-auto p-3">
    <span class="text-muted">Created by Yannik Ottens · © 2022</span>
  </div>
</footer>

 </body>
 
<script>
//settings
var timekeeping = true;
var skipSetting = true;
var timeEndSetting = false;
var submitSetting = true;

var modus = 0; //0: one question, 1: all questions

var count = 1;
var questionTime = 0;
var eventID = "<?php echo $event.$year; ?>";
var eventName = "<?php echo $event.substr($year,0,2); ?>";
var year = "<?php echo substr($year,0,2); ?>";
var engine = "<?php echo $engine; ?>";
var maxCount = 0;
var rigthAnswers = 0;
var arrayAnswers = [];
var questionID = 0;
var type = null;
var answerNumber = null;
var answerNumber2 = null;
var waiting;
var results = [];
var result= {
	"question": "",
	"yAnswer": "",
	"answer": "",
	"currect": ""
};

function load(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
			var r = "";
			var r = xmlHttp.responseText;
			var array = r.split(';');
			maxCount = array[0];
			document.getElementById("maxInfo").innerHTML = "Questions: "+maxCount;
			var minutes = Math.floor((array[1]/60) % 60);
			var hours = Math.floor(((array[1]/60)/60) % 60);
			document.getElementById("timeInfo").innerHTML = 'Time: '+hours+'h '+minutes+'m';
			loaddocuments();
		}
	xmlHttp.open( "GET", "/php/quizInfo.php?event="+eventID+"&engine="+engine, true );
	xmlHttp.send( null );
}

function loaddocuments(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
			var r = "";
			var r = xmlHttp.responseText;
			var links = r.split(';');
			var html = "";
			links.forEach(function(item){
				html += "<li>"+item+"</li>";
			});
			document.getElementById("doc").innerHTML = html;
		}
	xmlHttp.open( "GET", "/php/documents.php?event="+eventName+"&year="+year, true );
	xmlHttp.send( null );
}

function start(){
    document.getElementById("divStart").style.display = "none";
	document.getElementById("time").style.display = "block";
	switch(modus){
		case "0":
			setQuestion();
			break;
		case "1":
			for(var i = 0; i<count;i++){
				
			}
			break;
	}
	setTimeout(() => {  openQuestion(); }, 2000);
}

function settings(){
	submitSetting = document.getElementById("settingSubmit").checked;
	timekeeping = document.getElementById("settingTiming").checked;
	skipSetting = document.getElementById("settingSkip").checked;
	timeEndSetting = document.getElementById("settingAutoNextDiv").checked;
	document.getElementById("settingSkip").disabled = !timekeeping;
	document.getElementById("settingTimeEnd").disabled = !timekeeping;
	durationSetting = document.getElementById('durationSelect').value;
	document.getElementById("settingTimeEnd").checked = false;
	document.getElementById("settingSkip").checked = timekeeping;
}
function modusSwitch(){
	modus = document.getElementById('modusSelect').value;
	switch(modus) {
		case "0":
			document.getElementById('settingSkipDiv').style.display = "block";
			document.getElementById('settingTimeEndDiv').style.display = "block";
			document.getElementById('settingAutoNextDiv').style.display = "block";
			document.getElementById('settingSubmitDiv').style.display = "none";
		  	break;
		case "1":
			document.getElementById('settingSkipDiv').style.display = "none";
			document.getElementById('settingTimeEndDiv').style.display = "none";
			document.getElementById('settingAutoNextDiv').style.display = "none";
			document.getElementById('settingSubmitDiv').style.display = "block";
		  	break;
	  }
}
function setQuestion(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
			var r = "";
			var r = xmlHttp.responseText;
			var array = r.split(';');
			type = array[1];
			document.getElementById("questionText").innerHTML = array[0];
			result.question = array[0];
			if(array[2] > 0){
				document.getElementById("imgBox").style.display = "block";
				document.getElementById("imgBox").innerHTML="<div class='container'><div class='row'><div class='col'><img class='mx-auto d-block img-fluid' src='/img/"+eventID+"/"+array[2]+".jpg'></div></div></div>";
			}else{
				document.getElementById("imgBox").style.display = "none";
				document.getElementById("imgBox").innerHTML ="";
			}
			questionID = array[3];
			if(array[4] != "0"){
				document.getElementById("timeText").innerHTML = array[4];
			}else{
				document.getElementById("timeText").innerHTML = 600;
			}
			setAnswers();
		}
	xmlHttp.open( "GET", "/php/frage.php?event="+eventID+"&"+"number="+count+"&engine="+engine, true );
	xmlHttp.send( null );
}

function setAnswers(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
			var r = "";
			var r = xmlHttp.responseText;
			var lines = r.split("||");
			var bigHtml = "";
			var i = 0;
			result.answer = "";
			if(type =="range"){
				bigHtml += '<input type="text" class="form-control" id="numberInput" placeholder="Enter answer">';
				ans = r.split('@');
				a = ans[0].replace(/\u200B/g, '');
				antwort = a.split('-');
				answerNumber = antwort[0];
				answerNumber2 = antwort[1];
				result.answer= antwort[0] + " - " + antwort[1];
			} else if(type =="number"){
				bigHtml += '<input type="text" class="form-control" id="numberInput" placeholder="Enter answer">';
				ans = r.split('@');
				answerNumber = ans[0].replace(/\u200B/g, '');
				result.answer=ans[0].replace(/\u200B/g, '');
			}else{
				lines.forEach(function(item){
					ans = item.split('@');
					var html = "";
					if(type == "normal"){
						html += '<div class="form-check"><input class="form-check-input" type="radio" name="answer';
					}else{
						html += '<div class="form-check"><input class="form-check-input" type="checkbox" name="answer';
					}
					
					html += count;
					html += '" id="answer';
					html += i;
					html += '" value="'
					html += ans[1];
					if(ans[1]==1){
						result.answer+='<br>'+ans[0];
					}
					html += '" ans="'+ans[0];
					html += '"><label id="ansText" class="form-check-label" for="answer';
					html += i;
					html += '">';
					html += ans[0];
					html += '</label></div>';
					bigHtml += html;
					i++;
				});
			}
			document.getElementById("answerBody").innerHTML = bigHtml;
			
		}
	xmlHttp.open( "GET", "/php/answers.php?questionID="+questionID, true );
	xmlHttp.send( null );
}


function checkAnswerRadio(){
	stopTimming();
	result.yAnswer = '';
	options = document.getElementsByName("answer"+count);
	var ok = true;
	var check = false;
	if(type == "normal"){
		ok = false;
		options.forEach(function(item){
			if(item.checked == true){
				check = true;
				result.yAnswer += '<br>'+item.getAttribute('ans')+ ' ';
				if(item.value == "1"){
					ok = true;
				}
			}
		});
	}else if(type == "multi"){ //multi
		options.forEach(function(item){
			if(item.checked == true){
				check = true;
				result.yAnswer += '<br>'+item.getAttribute('ans');
				if(item.value == "0"){
					ok = false;
				}
			}else{
				if(item.value == "1"){
					ok = false;
				}
			}
		});
	}else if(type=="number"){
		result.yAnswer = document.getElementById('numberInput').value ;
		if(document.getElementById('numberInput').value == answerNumber){
			check = true;
			ok = true;
		}else{
			ok = false;
		}
	}else if (type == "range"){
		result.yAnswer = document.getElementById('numberInput').value;
		if(document.getElementById('numberInput').value >= answerNumber && document.getElementById('numberInput').value <= answerNumber2 ){
			check = true;
			ok = true;
		}else{
			ok = false;
		}
	}
	if(check == false){
		ok = false;
	}
	result.currect = ok;
	arrayAnswers[count] = ok;
	if(ok == true){
		rigthAnswers++;
		result.currect = "1";
	}
	results.push(Object.assign({}, result));
	closeQuestion();
}

function closeQuestion(){
    document.getElementById("quest").style.display = "none";
	document.getElementById("submitbutton").style.display = "none";
	if(skipSetting){
		document.getElementById("nextbutton").style.display = "block";
	}
    count++;
	if(count<=maxCount){
		setQuestion();
		if(timekeeping){
			waiting = true;
		}else{
			if(document.getElementById("settingAutoNext").checked){
				document.getElementById("next").style.display = "block";
			}else{
				openQuestion();
			}
		}
	}else{
		getResult();
	}
}
function getResult(){
	document.getElementById("count").innerHTML = "Result";
	document.getElementById("divResult").style.display = "block";
	document.getElementById("quest").style.display = "none";
	document.getElementById("submitbutton").style.display = "none";
	document.getElementById("nextbutton").style.display = "none";
	document.getElementById("time").style.display = "none";
	clearInterval(myVar);
	myVar = null;
	waiting = false;
	//time
	var seconds = timeQuiz % 60;
	var minutes = Math.floor((timeQuiz/60) % 60);
	var hours = Math.floor(((timeQuiz/60)/60) % 60);
	
	
	var html = "";
	var itemCount = 1;
	html += '<h1>Quiz result​:</h1>';
	if(timekeeping){
		html += '<p class="fs-5">Time: '+hours+'h '+minutes+'m '+seconds+'s '+'</p>';
	}
	html += '<div class="accordion" id="resultPanel">';
	results.forEach(function(item){
		html += '<div class="accordion-item">';
		html += '<h2 class="accordion-header" id="panelTitel'+itemCount+'">';
		html += '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panel'+itemCount+'" aria-expanded="false" aria-controls="panel'+itemCount+'">';
		if(item.currect == true){
			html += itemCount+'/'+maxCount+': passed';
		}else{
			html += itemCount+'/'+maxCount+': failed';
		}
		html += '</button></h2>';
		html += '<div id="panel'+itemCount+'" class="accordion-collapse collapse" aria-labelledby="panelTitel'+itemCount+'">';
		html += '<div class="accordion-body">';
		html += item.question;
		if(item.currect == true){
			html += '<p style="margin-bottom: 0; margin-left: 2rem;" class="text-success">You: '+item.yAnswer+'</p>';
		}else{
			html += '<p style="margin-bottom: 0; margin-left: 2rem;" class="text-danger">You: '+item.yAnswer+'</p>';
			html += '<p style="margin-left: 2rem;">Correct: '+item.answer+'</p>';
		}
		html +='</div></div></div>';
		itemCount++;
	});
	html += '</div>';
	document.getElementById("divResult").innerHTML += html;
}

function openQuestion(){
	clearInterval(myVar);
	myVar = null;
	waiting = false;
	if(timekeeping){
		setTimming();
		setTime(document.getElementById("timeText").innerHTML);
		document.getElementById("zeit").style.display = "block";
	}
	document.getElementById("zeit").innerHTML = "";
	document.getElementById("submitbutton").style.display = "block";
	document.getElementById("nextbutton").style.display = "none";
	document.getElementById("next").style.display = "none";
    document.getElementById("quest").style.display = "block";
	document.getElementById("count").innerHTML = (count)+"/"+(maxCount);
}
</script>
</html>