//timing Quiz
var quizTime = 0;
var quizTimeObj = null;

//timing Question
var nextQuestion = 0;
var nextQuestionObj = null;

//timing submit
var submitTime = 0;
var submitTimeObj = null;

function startSubmitTime(){
	document.getElementById('submitButton').disabled = true;
	submitTime = 30;
	submitTimeObj = setInterval(submitTimming, 1000);
}
function submitTimming(){
	submitTime--;
	if(submitTime<1){
		document.getElementById('submitButton').disabled = false;
		document.getElementById("submitButton").value = "Submit";
		clearInterval(submitTimeObj);
		submitTimeObj = null;
	}else{
		document.getElementById("submitButton").value = "Retry " +submitTime+"s";
	}
}
function startQuizTime(){
	quizTimeObj = setInterval(quizTimming, 1000);
}
function stopQuizTime(){
	clearInterval(quizTimeObj);
	quizTimeObj = null;
}
function stopNextQuestionTime(){
	clearInterval(nextQuestionObj);
	nextQuestionObj = null;
}
function startQuestionTime(){
	nextQuestionObj = null;
	nextQuestionObj = setInterval(nextQuestionTimming, 1000);
}
function addTimeToNextQuestionTime(addTime){
	nextQuestion += addTime;
	updateTimeUI();
}
function nextQuestionTimming(){
	nextQuestion--;
	updateTimeUI();
	if(nextQuestion<0){
		guestionTimeOver();
	}
}
function updateTimeUI(){
	if(nextQuestion<60){ //color
		document.getElementById("timeText").style.color = "red";
	}else{
		document.getElementById("timeText").style.color = "black";
	}
	if(nextQuestion>0){ //text
		document.getElementById("timeText").innerHTML = "Next question in: " + timeToSting(nextQuestion).substring(3);
	}else{
		document.getElementById("timeText").innerHTML = "Next question available";
	}
}
function quizTimming(){
	quizTime++;
}
function timeToSting(timeInSec) {
    var hours = Math.floor(timeInSec / 3600);
    var minutes = Math.floor((timeInSec - (hours * 3600)) / 60);
    var seconds = timeInSec - (hours * 3600) - (minutes * 60);
    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    return hours+'h '+minutes+'m '+seconds+'s'; //  HH : MM : SS
}