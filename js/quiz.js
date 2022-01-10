//info quiz
var maxQuestions = 0;
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
var modus = 0; //0: one question, 1: all questions
var results = [];
var result= {
	"question": "",
	"yAnswer": "",
	"answer": "",
	"currect": ""
};
var questionsIDs = [];

function loadFullQuiz(){
	getQuestionIDs();
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

function getQuestionIDs(){
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

function getQuestion(id){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
			var r = "";
			var r = xmlHttp.responseText;
			var a = r.split(';');
			setQuestion(a[0],a[1],a[2],a[3],getAnswers(id));
		}
	}
	xmlHttp.open( "GET", "/php/getQuestion.php?id="+id, true );
	xmlHttp.send( null );
}

function createHTMLQuestion(count, question, img, time, ID){
	var html = '<div class="question" id="quest'+count+'" style="display: none;">';
	html += '<p>'+question+'</p>';
	if(img>0){
		html += "<div class='container'><div class='row'><div class='col'><img class='mx-auto d-block img-fluid' src='/img/"+eventID+"/"+img+".jpg'></div></div></div>";
	}
	html += '<hr class="col-3 col-md-2">';
	result.question = $html+"";
	html += createHTMLAnswer(count, ID);
	html += '<hr class="col-3 col-md-2">';
	return html + '<p id="timeText'+count+'" style="display: none;">'+time+'</p></div>';
}

function createHTMLAnswer(count, ID, typ){
	var html = "";
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
			var r = "";
			var r = xmlHttp.responseText;
			var i = 0;
			result.answer = "";
			switch(typ) {
				case "range":
					var ans = r.split('@').replace(/\u200B/g, '');
					html += '<input answer="'+ans+'" type="text" class="form-control" id="numberInput'+count+'" placeholder="Enter answer">';
					break;
				case "number":
					var ans = r.split('@').replace(/\u200B/g, '')
					html += '<input answer="'+ans+'" type="text" class="form-control" id="numberInput'+count+'" placeholder="Enter answer">';
					break;
				default:
					var lines = r.split("||");
					lines.forEach(function(item){
						ans = item.split('@');
						var ansHtml = "";
						ansHtml += '<div class="form-check"><input class="form-check-input" type="';
						if(type == "normal"){
							ansHtml += 'radio';
						}else{
							ansHtml += 'checkbox';
						}
						ansHtml += '" name="answer'+count+'" id="answer'+i+'" value="'+ans[1];
						if(ans[1]==1){
							result.answer+='<br>'+ans[0];
						}
						ansHtml += '" ans="'+ans[0]+'"><label id="ansText" class="form-check-label" for="answer'+i+'">'+ans[0]+'</label></div>';
						html += ansHtml;
					});
					break;
			}
		}
	}
	xmlHttp.open( "GET", "/php/getAnswers.php?questionID="+ID, true );
	xmlHttp.send( null );
	return $html;
}

function buildQuiz(){
	switch(modus) {
		case "0"://single

		  	break;
		case "1": //all
			
		  	break;
	  }
}