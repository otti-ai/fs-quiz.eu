//info quiz
var maxQuestions = 0;
var currentQuestions = 0;
var quizDuration = 0;
var questionsWithoutDuration = 0;
var statisticID = 0;

//settings
var durationSetting = document.getElementById('durationSelect'); //in minutes
var timekeeping = document.getElementById("settingTiming");
var skipSetting = document.getElementById("settingSkip");
var timeEndSetting = document.getElementById("settingAutoNextDiv");
var submitSetting = document.getElementById("settingSubmit");


//quiz status
var resultShow = false;
var countTrue = 0;

var htmlResult = "";

var currentTyp = "";
var currentQuestionID = "";
var modus = "0"; //0: one question, 1: all questions
var results = [];
var result= {
	"question": "",
	"yAnswer": "",
	"answer": "",
	"currect": "",
	"solution": ""
};
var countLoad = 0;

var questionsIDs = [];

function loadFullQuiz(){
	durationSetting = document.getElementById('durationSelect'); //in minutes
	timekeeping = document.getElementById("settingTiming");
	skipSetting = document.getElementById("settingSkip");
	timeEndSetting = document.getElementById("settingAutoNextDiv");
	submitSetting = document.getElementById("settingSubmit");
	loaddocuments();
	loadInformation();
	modusSwitch();
	getQuiz();
}

function calculateDuration(){
	var duration = quizDuration + questionsWithoutDuration * (parseInt(durationSetting.value)*60);
	var minutes = Math.floor((duration/60) % 60);
	var hours = Math.floor(((duration/60)/60) % 60);
	return 'Duration: '+hours+'h '+minutes+'m';
}

function updateUI(){
	document.getElementById("maxInfo").innerHTML = "Questions: "+maxQuestions;
	document.getElementById("timeInfo").innerHTML = calculateDuration();
	if(questionsWithoutDuration>0){
		document.getElementById("timeInfo").innerHTML += "<br>"+questionsWithoutDuration + " without duration";
		switch(modus) {
			case "0":
				document.getElementById('durationSelectDiv').style.display = "block";
				break;
			case "1":
				document.getElementById('durationSelectDiv').style.display = "none";
				break;
		  }
	}else{
		document.getElementById('durationSelectDiv').style.display = "none";
	}
}

function modusSwitch(){
	modus = document.getElementById('modusSelect').value;
	switch(modus) {
		case "0":
			document.getElementById('durationSelectDiv').style.display = "block";
			document.getElementById('settingSkipDiv').style.display = "block";
			document.getElementById('settingTimeEndDiv').style.display = "block";
			document.getElementById('settingAutoNextDiv').style.display = "none";
			document.getElementById('settingSubmitDiv').style.display = "none";
		  	break;
		case "1":
			document.getElementById('durationSelectDiv').style.display = "none";
			document.getElementById('settingSkipDiv').style.display = "none";
			document.getElementById('settingTimeEndDiv').style.display = "none";
			document.getElementById('settingAutoNextDiv').style.display = "none";
			document.getElementById('settingSubmitDiv').style.display = "block";
		  	break;
	  }
}

function settings(){
	document.getElementById("durationSelect").disabled = !timekeeping.checked;
	document.getElementById("settingSkip").disabled = !timekeeping.checked;
	document.getElementById("settingTimeEnd").disabled = !timekeeping.checked;
	document.getElementById("settingTimeEnd").checked = false;
	document.getElementById("settingSkip").checked = timekeeping.checked;
	updateUI();
}

function start(){
	document.getElementById('divStart').style.display = "none";
	document.getElementById("questionFooter").style.display = "block";
	switch(modus) {
		case "0":
			startQuestionTime();
			showNextQuestion();
		  	break;
		case "1":
			for(var i = 0; i< maxQuestions; i++){
				document.getElementById('questTitel'+i).style.display = "block";
				document.getElementById('quest'+i).style.display = "block";
			}
			if(timekeeping.checked){//start full quiztime
				startQuizTime();
			}
			currentQuestions = -2;
		  	break;
	}
}

function showNextQuestion(){
	document.getElementById("submitButton").style.display = "";
	document.getElementById("submitButton").value = "Submit";
	document.getElementById("count").innerHTML = (currentQuestions+1)+"/"+(maxQuestions);
	document.getElementById('questionBody').style.display = "block";
	document.getElementById('quest'+currentQuestions).style.display = "block";
	if(timekeeping.checked){//start question time
		startQuizTime();
		addTimeToNextQuestionTime(getQuestionTime());
	}
}

function getQuestionTime(){
	var time = parseInt(document.getElementById('quest'+currentQuestions).getAttribute('data-time'));
	if(time<1 || isNaN(time)){
		time = parseInt(durationSetting.value)*60;
	}
	return time;
}
function guestionTimeOver(){
	if(resultShow){
		resultShow = false;
		submit();
	}
}
function submit(){
	document.getElementById('questionBody').style.display = "none";
	switch(modus) {
		case "0":
			if(currentQuestions<maxQuestions-1){
				document.getElementById('quest'+currentQuestions).style.display = "none";
				if(timekeeping.checked){
					stopQuizTime();
					if(nextQuestion>0){
						if(skipSetting.checked){
							if(resultShow){
								nextQuestion = 0;
								resultShow = false;
								submit();
							}else{
								document.getElementById("submitButton").value = "Skip";
								resultShow = true;
							}
						}else{
							document.getElementById("submitButton").style.display = "none";
						}
					}else{
						currentQuestions++;
						showNextQuestion();
					}
				}else{
					resultShow = false;
					currentQuestions++;
					showNextQuestion();
				}
			}else{
				checkAnswers();
				showResult();
			}
		  	break;
		case "1":
				checkAnswers();
				if(resultShow){
					document.getElementById('questionBody').style.display = "block";
					document.getElementById('divResult').style.display = "none";
					document.getElementById("submitButton").value = "Submit";
					resultShow = false;
					if(timekeeping.checked){
						startSubmitTime();
					}
				}else if ((submitSetting.checked && countTrue==maxQuestions) || !submitSetting.checked){
					showResult();
				}else{
					resultShow = true;
					document.getElementById("submitButton").value = "Retry";
				}
		  	break;
	}
}

function showResult(){
	if(timekeeping.checked){
		stopQuizTime();
		stopNextQuestionTime();
	}

	document.getElementById('questionFooter').style.display = "none";

	var html = "";
	html += '<h1>Quiz result​:</h1>';
	if(timekeeping.checked){
		html += '<p class="fs-5">Time: '+timeToSting(quizTime)+'</p>';
	}
	html += '<div class="accordion" id="resultPanel">';
	html += htmlResult;
	html += '</div>';
	document.getElementById("divResult").innerHTML = html;
}

function htmlResultPart(i,correct,yAnswer){
	var html = '<div class="accordion-item">';
	html += '<h2 class="accordion-header" id="panelTitel'+i+'"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panel'+i+'" aria-expanded="false" aria-controls="panel'+i+'">';
	if(correct){
		html += (i+1)+'/'+maxQuestions+': passed';
	}else{
		html += (i+1)+'/'+maxQuestions+': failed';
	}
	html += '</button></h2><div id="panel'+i+'" class="accordion-collapse collapse" aria-labelledby="panelTitel'+i+'"><div class="accordion-body"><p style="color:gray;margin:0px;" class"small fw-light">ID: '+jsondata.questions[i].question_id+'</p>';
	html += jsondata.questions[i].text.replace(/\\n/g,"<br />");
	jsondata.questions[i].images.forEach(img => {
		html += "<br><img class='img-fluid' src='https://img.fs-quiz.eu/"+img.path+"'>"
	});
	html += '<hr class="col-3 col-md-2">';
	switch (jsondata.questions[i].type) {
		case 'multi-choice':
			answers = jsondata.questions[i].answers;
			var c = 0;
			answers.forEach(function(ans){
				html += '<div class="form-check"><input disabled class="form-check-input';
				if(ans.is_correct){
					html += ' border-success';
					if(yAnswer[c]){
						html += ' bg-success';
					}
				}else if(yAnswer[c]){
					html += ' border-danger bg-danger';
				}

				html += '" type="checkbox" name="answer'+i+'" id="answer'+i+'"';
				if(yAnswer[c]){
					html += ' checked';
				}
				c++;
				html += '><label style="opacity: 1;" id="ansText" class="form-check-label ';
				if(ans.is_correct){
					html += 'text-success fw-bold';
				}
				html += '">'+ans.answer_text+'</label></div>';
			});
			  break;
		case 'single-choice':
			answers = jsondata.questions[i].answers;
			answers.forEach(function(ans){
				var givenAnswer = (ans.answer_text == yAnswer);
				html += '<div class="form-check"><input class="form-check-input';
				if(ans.is_correct){
					html += ' border-success';
					if(givenAnswer){
						html += ' bg-success';
					}
				}else if(givenAnswer){
					html += ' border-danger bg-danger';
				}
				html += '" type="radio" name="answer'+i+'" id="answer'+i+'"';
				if(givenAnswer){
					html += ' checked';
				}
				html += ' disabled><label style="opacity: 1;" id="ansText" class="form-check-label ';
				if(ans.is_correct){
					html += 'text-success fw-bold';
				}
				html += '">'+ans.answer_text+'</label></div>';
			});
			  break;
		default:
			answers = jsondata.questions[i].answers;
			html += '<input disabled type="text" class="form-control" id="numberInput'+i+'" placeholder="'+yAnswer+'"';
			if(!correct){
				html += 'style="border-color: red"';
			}
			html += '>';
			if(!correct){
				if(answers){
					html += '<br><p>Correct: ';
					html += answers.map(c => c.answer_text).join(' or ');
					html += '</p>';
				}else{
					html += '<br><p>Correct answer not available</p>';
				}
			}
			break;
	}
	html += '<hr class="col-3 col-md-2">';
	var solutions = jsondata.questions[i].solution;
	if(solutions.length > 0){
		html += '<p class="text-muted" style="margin-left: 2rem; font-size: smaller;">Solution:';
		solutions.forEach(element => {
			if(element.text){
				html += "<br>"+element.text.replace(/\\n/g,"<br />").replace("null","");
			}
			element.images.forEach(img => {
				html += "<br><img class='img-fluid' src='https://img.fs-quiz.eu/"+img.path+"'>"
			});
		});
		html += '</p>';
	}
	html += '</div></div></div>';
	return html;
}

function checkAnswers(){
	countTrue = 0;
	for(var i = 0; i< maxQuestions; i++){
		var yAnswer = "";
		var typ = jsondata.questions[i].type;
		var options = document.getElementsByName("answer"+i);
		var result = false;
		switch(typ) {
			case "single-choice":
				options.forEach(function(item){
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
				yAnswer = [];
				options.forEach(function(item){
					if(item.checked == true){
						yAnswer.push(true);
						if(item.value=="false"){
							result = false;
						}
					}else{
						yAnswer.push(false);
						if(item.value=="true"){
							result = false;
						}
					}
				});
				break;
			case "input":
				yAnswer = document.getElementById('numberInput'+i).value;
				result = false;
				jsondata.questions[i].answers.forEach(ans => {
					if(yAnswer == ans.answer_text){
						result = true;
					}
				});
				break;
			case "input-range":
				yAnswer = document.getElementById('numberInput'+i).value;
				var ans = jsondata.questions[i].answers[0].answer_text.split('-');
				if(yAnswer >= ans[0] && yAnswer <= ans[1] ){
					result = true;
				}else{
					result = false;
				};
		}
		if(result){
			countTrue++;
		}
		htmlResult += htmlResultPart(i,result,yAnswer);
		document.getElementById("resultCount").innerHTML = "Correct answers: " + countTrue + "/" + maxQuestions;
		document.getElementById('divResult').style.display = "block";
	}
}

function loadInformation(){
	var question = jsondata.questions;
	maxQuestions = question.length;
	questionsWithoutDuration = question.length;
	question.forEach(function(item){
		quizDuration = quizDuration + item.time;
		if(item.time>0){
			questionsWithoutDuration -= 1;
		}
	});
	updateUI();
}

function getQuiz(){//types anedern; bilder
	var html = "";
	var i = 0;
	var question = jsondata.questions;
	question.sort(function(a, b) {
		var keyA = new Date(a.position_index),
		  keyB = new Date(b.position_index);
		// Compare the 2 dates
		if (keyA < keyB) return -1;
		if (keyA > keyB) return 1;
		return 0;
	  });
	question.forEach(function(item){
		//question
		html += '<div class="question" data-id="'+item.question_id+'" data-time="'+item.time+'" id="quest'+i+'" style="display: none;"><p style="color:gray;margin:0px;" class="small fw-light">ID: '+item.question_id+'</p><h4 style="display: none;" id="questTitel'+i+'">Question: '+(i+1)+'</h4><div id="questText'+i+'">';
		html += '<p>'+item.text.replace(/\\n/g,"<br />")+'</p>';
		var images = item.images
		if(images.length>0){
			html += "<div class='container'><div class='row'><div class='col'>";
			images.forEach(function(img){
				html += "<img class='mx-auto d-block img-fluid' src='https://img.fs-quiz.eu/"+img.path+"'>";
			});
			html += '</div></div></div>';
		}
		html += '</div><hr class="col-3 col-md-2">';
		//answer
		switch (item.type) {
			case 'multi-choice':
				$c = 0;
				answers = item.answers;
				answers.forEach(function(ans){
					html += '<div class="form-check"><input class="form-check-input" type="checkbox" name="answer'+i+'" id="answer'+i+'" value="'+ans.is_correct;
					html += '" data-ans="'+ans.answer_text+'"><label id="ansText" class="form-check-label">'+ans.answer_text+'</label></div>';
					$c++;
				});
			  	break;
			case 'single-choice':
				$c = 0;
				answers = item.answers;
				answers.forEach(function(ans){
					html += '<div class="form-check"><input class="form-check-input" type="radio" name="answer'+i+'" id="answer'+i+'" value="'+ans.is_correct;
					html += '" data-ans="'+ans.answer_text+'"><label id="ansText" class="form-check-label">'+ans.answer_text+'</label></div>';
					$c++;
				});
			  	break;
			default:
				answers = item.answers[0];
				if(answers){
					html += '<input data-answer="'+answers.answer_text+'" type="text" class="form-control" id="numberInput'+i+'" placeholder="Enter answer">';
				}else{
					html += '<input data-answer="" type="text" class="form-control" id="numberInput'+i+'" placeholder="Enter answer">';
				}
				break;
		  }
		  html += '<hr class="col-3 col-md-2"></div>';
		  i++;
	});
	document.getElementById("questionBody").innerHTML = html.replace(new RegExp('\r?\n','g'), '<br />');
	//statisticID = document.getElementById('quest1').getAttribute('data-id');
}
function loaddocuments(){
	var documents = jsondata.documents;
	documents.forEach(function(item){
		if(item.version == "online"){
			document.getElementById("doc").innerHTML += "<li><a href='"+item.path+"' target='_blank'/>"+jsondata.event[0].short_name+"_"+item.type+"_"+jsondata.year+"(online)</li>";
		}else{
			document.getElementById("doc").innerHTML += "<li><a href='https://doc.fs-quiz.eu/"+item.path+"' target='_blank'/>"+item.path.substring(0,item.path.length-4)+"</li>";
		}
	});
}