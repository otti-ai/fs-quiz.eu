<?php
$jsonData = file_get_contents('http://api.fs-quiz.eu/2/question/'. $question_id);
$data = json_decode(nl2br($jsonData));
require('header.php'); 
?>
  
<div class="col-lg-8 mx-auto p-3">
  <main>
	<div id="divResult" style="display: none;">
	</div>
	<div id="questionBody">
		
	</div>
	<div id="time" style="display: block;">
		<div class="row">
			<div class="col"></div>
			<div class="col text-center">
				<p class="fs-5" id="zeit"></p>
			</div>
			<div id="submitbutton" class="col text-end">
				<input class="btn btn-primary" onclick="checkAnswers()" type="submit" value="Submit">
			</div>
			<div id="nextbutton" class="col text-end" style="display: none;">
			</div>
		</div>
</div>
 
</div> 
  </main>
  <footer class="footer mt-auto bg-light">
  <div class="col-lg-8 mx-auto p-3 text-dark">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <a href="../kontakt" class="text-muted" style="text-decoration: none;">Contact</a>
    </div>
    <div class="col-md-auto">
      <a href="../legal-notice" class="text-muted" style="text-decoration: none;">Legal notice</a>
    </div>
    <div class="col-md-auto">
      <a href="../privacy" class="text-muted" style="text-decoration: none;">Privacy Policy</a>
    </div>
  </div>
  <div class="row justify-content-md-center">
  <div class="col-md-auto text-muted mt-2">
      <a> Created by Yannik Ottens · © <?php echo date('Y'); ?></a>
    </div>
  </div>
  </div>
</footer>

 </body>
 
<script>
var jsondata = <?php echo json_encode($data); ?>;
var htmlResult = "";

renderQuestion();

function renderQuestion(){
	html = ""
	html += '<div class="question" data-id="'+jsondata.question_id+'" data-time="'+jsondata.time+'" data-typ="'+jsondata.type+'" id="quest" style="display: block;"><p style="color:gray;margin:0px;" class"small fw-light">ID: '+jsondata.question_id+'</p><div id="questText">';
	html += '<p>'+jsondata.text.replace(/\\n/g,"<br />")+'</p>';
	var images = jsondata.images
	if(images.length>0){
		html += "<div class='container'><div class='row'><div class='col'>";
		images.forEach(function(img){
			html += "<img class='mx-auto d-block img-fluid' src='https://img.fs-quiz.eu/"+img.path+"'>";
		});
		html += '</div></div></div>';
	}
	html += '</div><hr class="col-3 col-md-2">';
	//answer
	switch (jsondata.type) {
		case 'multi-choice':
			$c = 0;
			answers = jsondata.answers;
			answers.forEach(function(ans){
				html += '<div class="form-check"><input class="form-check-input" type="checkbox" name="answer" id="answer" value="'+ans.is_correct;
				html += '" data-ans="'+ans.answer_text+'"><label id="ansText" class="form-check-label">'+ans.answer_text+'</label></div>';
				$c++;
			});
			break;
		case 'single-choice':
			$c = 0;
			answers = jsondata.answers;
			answers.forEach(function(ans){
				html += '<div class="form-check"><input class="form-check-input" type="radio" name="answer" id="answer" value="'+ans.is_correct;
				html += '" data-ans="'+ans.answer_text+'"><label id="ansText" class="form-check-label">'+ans.answer_text+'</label></div>';
				$c++;
			});
		  	break;
		default:
			answers = jsondata.answers[0];
			html += '<input data-answer="'+answers.answer_text+'" type="text" class="form-control" id="numberInput" placeholder="Enter answer">';
			break;
	}
	html += '<hr class="col-3 col-md-2"></div>';
	document.getElementById("questionBody").innerHTML = html.replace(/\\n/g,"<br />");
}

function checkAnswers(){
	var question = document.getElementById('questText').innerHTML;
	var id = document.getElementById('quest').getAttribute('data-id');
	var yAnswer = "";
	var answer = "";
	var typ = document.getElementById('quest').getAttribute('data-typ');
	var options = document.getElementsByName("answer");
	var result = false;
	switch(typ) {
		case "single-choice":
			options.forEach(function(item){
				if(item.value == "true"){
					answer = item.getAttribute('data-ans');
				}
				if(item.checked == true){
					yAnswer = item.getAttribute('data-ans');
					if(item.value == "true"){
						result = true;
					}
				}
			});
			break;
		case "multi-choice":
			result = true;
			options.forEach(function(item){
				if(item.value == "true"){
					answer += item.getAttribute('data-ans')+"<br>";
				}
				if(item.checked == true){
					yAnswer += item.getAttribute('data-ans')+"<br>";
					if(item.value=="false"){
						result = false;
					}
				}else{
					if(item.value=="true"){
						result = false;
					}
				}
			});
			break;
		case "input":
			yAnswer = document.getElementById('numberInput').value;
			answer += document.getElementById('numberInput').getAttribute('data-answer');
			if(document.getElementById('numberInput').value == document.getElementById('numberInput').getAttribute('data-answer')){
				result = true;
			}else{
				result = false;
			}
			break;
		case "input-range":
			yAnswer = document.getElementById('numberInput').value;
			answer += document.getElementById('numberInput').getAttribute('data-answer');
			var ans = document.getElementById('numberInput').getAttribute('data-answer').split('-');
			if(document.getElementById('numberInput').value >= ans[0] && document.getElementById('numberInput').value <= ans[1] ){
				result = true;
			}else{
				result = false;
			};
	}
	htmlResult += htmlResultPart(result,question,yAnswer,answer, id);
	document.getElementById('divResult').style.display = "block";
	showResult();
}

function htmlResultPart(correct,question,yAnswer,answer, id){
	var html = '<p style="color:gray;margin:0px;" class"small fw-light">ID: '+id+'</p>';
	html += question;
	html += '<p style="margin-bottom: 0; margin-left: 2rem;" class="';
	if(correct){
		html += 'text-success';
	}else{
		html += 'text-danger';
	}
	html += '">You:<br>'+yAnswer+'</p><p style="margin-left: 2rem;">Correct:<br>'+answer+'</p>';
	html += renderSolution();
	return html;
}

function renderSolution(){
	var html ="";
	var solutions = jsondata.solution;
	if(solutions.length>0){
		html += "<hr><h3>Solution:</h3>";
		solutions.forEach(function(item){
			if(item.text){
				html += '<p>' + item.text.replace(/\\n/g,"<br />"); + '</p>';
			}
			var images = item.images;
			images.forEach(function(img){
				html += '<img class="mx-auto d-block img-fluid" src="https://img.fs-quiz.eu/'+img.path+'"/>';
			});
		});
	}
	return html;
}

function showResult(){
	document.getElementById('questionBody').style.display = "none";
	document.getElementById('time').style.display = "none";
	document.getElementById('divResult').style.display = "block";
	var html = "";
	html += '<h1>Result​:</h1>';
	html += htmlResult;
	document.getElementById("divResult").innerHTML = html;
}
</script>
</html>