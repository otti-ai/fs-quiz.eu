var myVar = null;
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