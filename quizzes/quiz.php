<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet">
	<script src="../js/bootstrap.js"></script>
	
	
    <title>FS-Quiz - FSN19</title>
  </head>
  <body onload="load()" class="d-flex flex-column min-vh-100"> 
	<header class="p-3 bg-dark text-white">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid col-lg-8">
				<a class="navbar-brand" >FS-Quiz Netherland 2019</a>
				<a class="navbar-brand" id="count"></a>
			</div>
		</nav>
	</header>
  
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
	<div id="divStart" style="display: block;">
		<h1>FS Netherland Registration Quiz 2019​</h1>
		<div class="row g-5">
		<div class="col-md-6">
			<h3>Infomation</h3>
			<p style="margin-bottom: 0;">Questions: 20</p>
		</div>
		<div class="col-md-6">
			<h3>Settings</h3>
			<div class="form-check form-switch">
				<input onclick="settings();" class="form-check-input" type="checkbox" id="settingTiming" checked>
				<label class="form-check-label" for="settingTiming">Time to next question</label>
			</div>
			<div style="margin-left: 2rem;" class="form-check form-switch">
				<input class="form-check-input" type="checkbox" id="settingSkip" checked>
				<label class="form-check-label" for="settingSkip">Allow skip time to next question</label>
			</div>
			<div style="margin-left: 2rem;" class="form-check form-switch">
				<input class="form-check-input" type="checkbox" id="settingTimeEnd">
				<label class="form-check-label" for="settingTimeEnd">End question with expired time</label>
			</div>
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" id="settingTiming" checked>
				<label class="form-check-label" for="settingTiming">Show participation prediction</label>
			</div>
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" id="settingAutoNext" checked>
				<label class="form-check-label" for="settingAutoNext">Next question prompt</label>
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
		<div class="col-sm-4 mx-auto" id="imgBox">
		</div>
		<hr class="col-3 col-md-2">
		<div id="answerBody">
			
		</div>
		<hr class="col-3 col-md-2">
		<p id="timeText" style="display: none;">30</p>
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
  <footer class="mt-auto pt-5 my-5 text-muted border-top">
  <div class="col-lg-8 mx-auto">
    Created by Yannik Ottens · © 2021
	</div>
  </footer>

 </body>
 
<script>
var count = 0;
var eventID = <?php echo json_encode($_GET['event']); ?>;
var maxCount = 0;
var rigthAnswers = 0;
var arrayAnswers = [];
var questionID = 0;
var type = null;
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
			loaddocuments();
		}
	xmlHttp.open( "GET", "../php/quizInfo.php?event="+eventID, true );
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
	xmlHttp.open( "GET", "../php/documents.php?event="+eventID, true );
	xmlHttp.send( null );
}

function start(){
    count++;
    document.getElementById("divStart").style.display = "none";
	document.getElementById("time").style.display = "block";
	setQuestion();
	openQuestion();
}

function settings(){
	document.getElementById("settingTimeEnd").checked = false;
	document.getElementById("settingTimeEnd").disabled = !document.getElementById("settingTiming").checked;
	document.getElementById("settingSkip").checked = document.getElementById("settingTiming").checked;
	document.getElementById("settingSkip").disabled = !document.getElementById("settingTiming").checked;
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
				document.getElementById("imgBox").innerHTML="<img class='img-fluid' src='../img/"+eventID+"/"+array[2]+".jpg'>";
			}else{
				document.getElementById("imgBox").style.display = "none";
				document.getElementById("imgBox").innerHTML ="";
			}
			questionID = array[3];
			//type
			setAnswers();
		}
	xmlHttp.open( "GET", "../php/frage.php?event="+eventID+"&"+"number="+count, true );
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
			lines.forEach(function(item){
				ans = item.split('@');
				var html = "";
				if(type == "normal"){
					html += '<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="answer';
				}else{
					html += '<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="answer';
				}
				
				html += count;
				html += '" id="answer';
				html += i;
				html += '" value="'
				html += ans[1];
				if(ans[1]==1){
					result.answer=ans[0];
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
			document.getElementById("answerBody").innerHTML = bigHtml;
			
		}
	xmlHttp.open( "GET", "../php/answers.php?questionID="+questionID, true );
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
				result.yAnswer = item.getAttribute('ans');
				if(item.value == "1"){
					ok = true;
				}
			}
		});
	}else{ //multi
		options.forEach(function(item){
			if(item.checked == true){
				check = true;
				if(item.value == "0"){
					ok = false;
				}else{
					
				}
			}else{
				if(item.value == "1"){
					ok = false;
				}
			}
		});
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
	if(document.getElementById("settingSkip").checked){
		document.getElementById("nextbutton").style.display = "block";
	}
    count++;
	if(count<=maxCount){
		setQuestion();
		if(document.getElementById("settingTiming").checked){
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
	if(document.getElementById("settingTiming").checked){
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
			html += '<p style="margin-left: 2rem;">Currect: '+item.answer+'</p>';
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
	if(document.getElementById("settingTiming").checked){
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
//timming
var timeQuiz = 0;
var timeQuizObj = null;

function setTimming(){
	timeQuizObj = setInterval(quizTimer, 1000);
}
function stopTimming(){
	clearInterval(timeQuizObj);
	timeQuizObj = null;
}

function quizTimer(){
	timeQuiz++;
}

//zeit
var myVar = null;
	
	function setTime(time){
		myVar = null;
		timestamp =time;
		myVar = setInterval(myTimer, 1000)
	}

	function component(x, v) {
		return Math.floor(x / v);
	}

	function myTimer() {
		if(timestamp>0){
			timestamp--;
			var minutes = component(timestamp,60) % 60,
				seconds = component(timestamp,1) % 60;
			if(seconds<10){
				document.getElementById("zeit").innerHTML = "Next question in: " + minutes + ":0" + seconds;
			}else{
				document.getElementById("zeit").innerHTML = "Next question in: " + minutes + ":" + seconds;
			}
			if(timestamp<30){
				document.getElementById("zeit").style.color = "red";
			}else{
				document.getElementById("zeit").style.color = "black";
			}
		}else if (timestamp<=0){
			timestamp--;
			document.getElementById("zeit").innerHTML = "Time is over";
			if(waiting == true){
				setQuestion();
				document.getElementById("next").style.display = "block";
				document.getElementById("nextbutton").style.display = "none";
				document.getElementById("zeit").style.display = "none";
			}
			clearInterval(myVar);
			myVar = null;
			if(document.getElementById("settingTimeEnd").checked){
				checkAnswerRadio();
			}
		}
	}

</script>
</html>