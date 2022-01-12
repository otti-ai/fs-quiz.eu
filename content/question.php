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
	<script src="/js/time.js"></script>
	
    <title>FS-Quiz - Question</title>
  </head>
  <body onload="setQuestion()" class="d-flex flex-column min-vh-100"> 
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
	<div id="divResult" style="display: none;">
	</div>
	<div class="question" id="quest" style="display: block;">
		<p class="fs-5" id="questionText">Need a Question</p>
		<div class="" id="imgBox">
		</div>
		<hr class="col-3 col-md-2">
		<div id="answerBody">
			
		</div>
		<hr class="col-3 col-md-2">
	</div>
	<div id="time" style="display: block;">
		<div class="row">
			<div class="col"></div>
			<div class="col text-center">
				<p class="fs-5" id="zeit"></p>
			</div>
			<div id="submitbutton" class="col text-end">
				<input class="btn btn-primary" onclick="checkAnswerRadio()" type="submit" value="Submit">
			</div>
			<div id="nextbutton" class="col text-end" style="display: none;">
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
var questionID = "<?php echo $_GET['id'];//$questionID; ?>";
var type = '';
var answer = "";
var answerNumber;
var answerNumber2;
var yAnswer;
var currect;
var question;
var eventID;
var solution;
function setQuestion(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
			var r = "";
			var r = xmlHttp.responseText;
			var array = r.split(';');
			type = array[1];
			document.getElementById("questionText").innerHTML = array[0];
			question = array[0];
			eventID = array[4];
			if(array[2] > 0){
				document.getElementById("imgBox").style.display = "block";
				document.getElementById("imgBox").innerHTML="<div class='container'><div class='row'><div class='col'><img class='mx-auto d-block img-fluid' src='/img/"+eventID+"/"+array[2]+".jpg'></div></div></div>";
			}else{
				document.getElementById("imgBox").style.display = "none";
				document.getElementById("imgBox").innerHTML ="";
			}
			setAnswers();
		}
	xmlHttp.open( "GET", "/php/getQuestion.php?id="+questionID, true );
	xmlHttp.send( null );
}

function setSolution(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
			var r = "";
			solution = "";
			var r = xmlHttp.responseText;
			var array = r.split(';');
			array.forEach(function(item){
				s = item.split('@');
				if(s[0].includes("text")){
					solution += "<p>"+s[1]+"</p><br>";
				}else if(s[0].includes("bild")){
					solution +=  "<img class='img-fluid' src='/img/solution/"+s[1]+"'>";
				}
			});
		}
	xmlHttp.open( "GET", "/php/getSolution.php?id="+questionID, true );
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
			answer = "";
			if(type =="range"){
				bigHtml += '<input type="text" class="form-control" id="numberInput" placeholder="Enter answer">';
				ans = r.split('@');
				a = ans[0].replace(/\u200B/g, '');
				antwortt = a.split('-');
				answerNumber = antwortt[0];
				answerNumber2 = antwortt[1];
				answer= antwortt[0] + " - " + antwortt[1];
			} else if(type =="number"){
				bigHtml += '<input type="text" class="form-control" id="numberInput" placeholder="Enter answer">';
				ans = r.split('@');
				answerNumber = ans[0].replace(/\u200B/g, '');
				answer=ans[0].replace(/\u200B/g, '');
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
						answer+='<br>'+ans[0];
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
			setSolution();
		}
	xmlHttp.open( "GET", "/php/answers.php?questionID="+questionID, true );
	xmlHttp.send( null );
}


function checkAnswerRadio(){
	yAnswer = '';
	options = document.getElementsByName("answer"+count);
	var ok = true;
	var check = false;
	if(type == "normal"){
		ok = false;
		options.forEach(function(item){
			if(item.checked == true){
				check = true;
				yAnswer += '<br>'+item.getAttribute('ans')+ ' ';
				if(item.value == "1"){
					ok = true;
				}
			}
		});
	}else if(type == "multi"){ //multi
		options.forEach(function(item){
			if(item.checked == true){
				check = true;
				yAnswer += '<br>'+item.getAttribute('ans');
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
		yAnswer = document.getElementById('numberInput').value ;
		if(document.getElementById('numberInput').value == answerNumber){
			check = true;
			ok = true;
		}else{
			ok = false;
		}
	}else if (type == "range"){
		yAnswer = document.getElementById('numberInput').value;
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
	currect = ok;
	if(ok == true){
		rigthAnswers++;
		currect = "1";
	}
	closeQuestion();
}

function closeQuestion(){
    document.getElementById("quest").style.display = "none";
	document.getElementById("submitbutton").style.display = "none";
	getResult();
}
function getResult(){
	document.getElementById("count").innerHTML = "Result";
	document.getElementById("divResult").style.display = "block";
	document.getElementById("quest").style.display = "none";
	document.getElementById("submitbutton").style.display = "none";
	document.getElementById("nextbutton").style.display = "none";
	document.getElementById("time").style.display = "none";
	var html = "";
	html += '<h1>Quiz result​:</h1>';
	html += '<div class="accordion" id="resultPanel">';
		html += '<div class="accordion-item">';
		html += '<h2 class="accordion-header" id="panelTitel">';
		html += '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panel" aria-expanded="false" aria-controls="panel">';
		if(currect == true){
			html += 'passed';
		}else{
			html += 'failed';
		}
		html += '</button></h2>';
		html += '<div id="panel" class="accordion-collapse collapse" aria-labelledby="panelTitel">';
		html += '<div class="accordion-body">';
		html += question;
		if(currect == true){
			html += '<p style="margin-bottom: 0; margin-left: 2rem;" class="text-success">You: '+yAnswer+'</p>';
		}else{
			html += '<p style="margin-bottom: 0; margin-left: 2rem;" class="text-danger">You: '+yAnswer+'</p>';
			html += '<p style="margin-left: 2rem;">Correct: '+answer+'</p>';
			html += "<p>Solution:</p><br>"+solution;
		}
		html +='</div></div></div>';
	html += '</div>';
	document.getElementById("divResult").innerHTML += html;
	
}
</script>
</html>