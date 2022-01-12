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
	<script src="/js/time.js"></script>
	<script src="/js/quiz.js"></script>
	
    <title>FS-Quiz - Play</title>
  </head>
  <body onload="loadFullQuiz()" class="d-flex flex-column min-vh-100"> 
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
			<div id="durationSelectDiv" style="margin-left: 0.5rem;" class="form-check">
				<label for="durationSelect">Duration: </label>
				<select data-bs-toggle="tooltip" data-bs-placement="top" title="Duration for Questions without duration in minutes" onchange="settings()" class=" form-select-sm" id="durationSelect" aria-label="durationSelect">
					<option value="5" selected>5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
				</select>
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
			<div class="form-check form-switch" id="settingSubmitDiv">
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
	<div id="questionBody">
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
var eventID = "<?php echo $event.$year; ?>";
var year = "<?php echo substr($year,0,2); ?>";
var engine = "<?php echo $engine; ?>";
</script>
</html>