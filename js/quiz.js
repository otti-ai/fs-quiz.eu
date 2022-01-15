//info quiz
var maxQuestions = 0;
var currentQuestions = 0;
var quizDuration = 0;
var questionsWithoutDuration = 0;

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
	"currect": ""
};
var countLoad = 0;

var questionsIDs = [];

function loadFullQuiz(){
	durationSetting = document.getElementById('durationSelect'); //in minutes
	timekeeping = document.getElementById("settingTiming");
	skipSetting = document.getElementById("settingSkip");
	timeEndSetting = document.getElementById("settingAutoNextDiv");
	submitSetting = document.getElementById("settingSubmit");
	getQuestionIDs();//can remove 
	getQuiz();
	loaddocuments();
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
			document.getElementById('settingAutoNextDiv').style.display = "block";
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
	document.getElementById("guestionFooter").style.display = "block";
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
	if(time<1){
		time = dparseInt(durationSetting.value)*60;
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

	document.getElementById('guestionFooter').style.display = "none";

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

function htmlResultPart(i,correct,question,yAnswer,answer){
	var html = '<div class="accordion-item">';
	html += '<h2 class="accordion-header" id="panelTitel'+i+'"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panel'+i+'" aria-expanded="false" aria-controls="panel'+i+'">';
	if(correct){
		html += i+'/'+maxQuestions+': passed';
	}else{
		html += i+'/'+maxQuestions+': failed';
	}
	html += '</button></h2><div id="panel'+i+'" class="accordion-collapse collapse" aria-labelledby="panelTitel'+i+'"><div class="accordion-body">';
	html += question;
	html += '<p style="margin-bottom: 0; margin-left: 2rem;" class="';
	if(correct){
		html += 'text-success';
	}else{
		html += 'text-danger';
	}
	html += '">You: '+yAnswer+'</p><p style="margin-left: 2rem;">Correct: '+answer+'</p></div></div></div>';
	return html;
}

function checkAnswers(){
	countTrue = 0;
	for(var i = 0; i< maxQuestions; i++){
		var question = document.getElementById('questText'+i).innerHTML;
		var yAnswer = "";
		var answer = "";
		var typ = document.getElementById('quest'+i).getAttribute('data-typ');
		var options = document.getElementsByName("answer"+i);
		var result = false;
		switch(typ) {
			case "normal":
				options.forEach(function(item){
					if(item.value == "1"){
						answer = item.getAttribute('data-ans');
					}
					if(item.checked == true){
						yAnswer = item.getAttribute('data-ans');
						if(item.value == "1"){
							result = true;
						}
					}
				});
				break;
			case "multi":
				options.forEach(function(item){
					result = true;
					if(item.value == "1"){
						answer += item.getAttribute('data-ans');
					}
					if(item.checked == true){
						yAnswer += item.getAttribute('data-ans');
						if(item.value=="0"){
							result = false;
						}
					}
					if(item.checked == false && item.value == "1"){
						result = false;
					}
				});
				break;
			case "number":
				yAnswer = document.getElementById('numberInput'+i).value;
				answer += document.getElementById('numberInput'+i).getAttribute('data-answer');
				if(document.getElementById('numberInput'+i).value == document.getElementById('numberInput'+i).getAttribute('data-answer')){
					result = true;
				}else{
					result = false;
				}
				break;
			case "range":
				yAnswer = document.getElementById('numberInput'+i).value;
				answer += document.getElementById('numberInput'+i).getAttribute('data-answer');
				var ans = document.getElementById('numberInput'+i).getAttribute('data-answer').split('-');
				if(document.getElementById('numberInput'+i).value >= ans[0] && document.getElementById('numberInput'+i).value <= ans[1] ){
					result = true;
				}else{
					result = false;
				};
		}
		if(result){
			countTrue++;
		}
		htmlResult += htmlResultPart(i,result,question,yAnswer,answer);
		document.getElementById("resultCount").innerHTML = "Correct answers: " + countTrue + "/" + maxQuestions;
		document.getElementById('divResult').style.display = "block";
	}
}

function getQuestionIDs(){//todo
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
			var r = "";
			var r = xmlHttp.responseText;
			var a = r.split(';');
			maxQuestions = a.length;
			a.forEach(function(item){
				f = item.split("@");
				questionsIDs.push(f[0]);
				quizDuration = quizDuration+ parseInt(f[1]);
				if(f[1]<1){
					questionsWithoutDuration += 1;
				}
			});
			updateUI();
		}
	}
	xmlHttp.open( "GET", "/php/getQuestionsIDs.php?engine="+engine+"&event="+eventID, true );
	xmlHttp.send( null );
}
function getQuiz(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
			var r = "";
			var r = xmlHttp.responseText;
			document.getElementById("questionBody").innerHTML = r;
		}
	}
	xmlHttp.open( "GET", "/php/getQuiz.php?engine="+engine+"&event="+eventID, true );
	xmlHttp.send( null );
}
function loaddocuments(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
			var r = "";
			var r = xmlHttp.responseText;
			var ans = r.split(';');
			var html = "";
			ans.forEach(function(item){
				var link = item.split('@')[0];
				html += "<li>"+link+"</li>";
			});
			document.getElementById("doc").innerHTML = html;
		}
	xmlHttp.open( "GET", "/php/getDocuments.php?e="+event+"&y="+year, true );
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