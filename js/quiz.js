//info quiz
var maxQuestions = 0;
var currentQuestions = 0;
var quizDuration = 0;
var questionsWithoutDuration = 0;

//settings
var durationSetting = 5; //in minutes
var timekeeping = true;
var skipSetting = true;
var timeEndSetting = false;
var submitSetting = true;

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
	getQuestionIDs();
	getQuiz();
}

function calculateDuration(){
	var duration = quizDuration + questionsWithoutDuration * (durationSetting*60);
	var minutes = Math.floor((duration/60) % 60);
	var hours = Math.floor(((duration/60)/60) % 60);
	return 'Duration: '+hours+'h '+minutes+'m';
}

function updateUI(){
	document.getElementById("maxInfo").innerHTML = "Questions: "+maxQuestions;
	document.getElementById("timeInfo").innerHTML = calculateDuration();
	if(questionsWithoutDuration>0){
		document.getElementById("timeInfo").innerHTML += "<br>"+questionsWithoutDuration + " without duration";
		document.getElementById('durationSelectDiv').style.display = "block";
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
	submitSetting = document.getElementById("settingSubmit").checked;
	timekeeping = document.getElementById("settingTiming").checked;
	skipSetting = document.getElementById("settingSkip").checked;
	timeEndSetting = document.getElementById("settingAutoNextDiv").checked;
	document.getElementById("durationSelect").disabled = !timekeeping;
	document.getElementById("settingSkip").disabled = !timekeeping;
	document.getElementById("settingTimeEnd").disabled = !timekeeping;
	durationSetting = document.getElementById('durationSelect').value;
	document.getElementById("settingTimeEnd").checked = false;
	document.getElementById("settingSkip").checked = timekeeping;
	updateUI();
}

function start(){
	document.getElementById('divStart').style.display = "none";
	document.getElementById("guestionFooter").style.display = "block";
	switch(modus) {
		case "0":
			showNextQuestion();
		  	break;
		case "1":
			for(var i = 0; i< maxQuestions; i++){
				//wait
				document.getElementById('quest'+i).style.display = "block";
				//time
			}
		  	break;
	}
}

function showNextQuestion(){
	document.getElementById("count").innerHTML = (currentQuestions+1)+"/"+(maxQuestions);
	document.getElementById('questionBody').style.display = "block";
	document.getElementById('quest'+currentQuestions).style.display = "block";

	//time
}

function submit(){
	//timestop
	document.getElementById('questionBody').style.display = "none";
	switch(modus) {
		case "0":
			if(currentQuestions<maxQuestions-1){
				document.getElementById('quest'+currentQuestions).style.display = "none";
				currentQuestions++;
				showNextQuestion();
			}else{
				checkAnswers();
			}
		  	break;
		case "1":
			for(var i = 0; i< maxQuestions; i++){
				//time
			}
		  	break;
	}
}

function checkAnswers(){
	var countTrue = 0;
	for(var i = 0; i< maxQuestions; i++){
		var typ = document.getElementById('quest'+i).getAttribute('data-typ');
		var result = false;
		var check = false;
		switch(typ) {
			case "normal":
				result = 
				options.forEach(function(item){
					if(item.checked == true){
						check = true;
						result.yAnswer += '<br>'+item.getAttribute('ans')+ ' ';
						if(item.value == "1"){
							ok = true;
						}
					}
				});
				break;
			case "multi":
				break;
			case "multi":
				break;
			case "multi":
				break;
		}
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