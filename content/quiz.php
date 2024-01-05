<?php
require($_SERVER['DOCUMENT_ROOT']. '/api/1/orginal_db.php');
$jsonData = file_get_contents('http://api.fs-quiz.eu/2/quiz/'. $quiz_id);
$data = json_decode(nl2br($jsonData));
$eventName = 'FS ';
foreach ($data->event as $row) {
    $eventName .= str_replace('Formula Student ', '', $row->event_name) . '/';
}
$eventName = substr($eventName,0,-1);

require($_SERVER['DOCUMENT_ROOT']. '/statistic.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- ICONS-->
	<link rel="apple-touch-icon" sizes="57x57" href="../img/icons/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="../img/icons/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../img/icons/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../img/icons/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../img/icons/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../img/icons/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="../img/icons/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="../img/icons/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="../img/icons/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="../img/icons/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../img/icons/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../img/icons/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../img/icons/favicon/favicon-16x16.png">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="../img/icons/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="../js/bootstrap.min.js"></script>
	
	<!-- Quiz -->
	<script src="../js/quiz.js?<%=DateTime.Now.Ticks.ToString()%>"></script>
	<script src="../js/time.js?<%=DateTime.Now.Ticks.ToString()%>"></script>
	
    <title>FS-Quiz - Play</title>
  </head>
  <body onload="loadFullQuiz()" class="d-flex flex-column min-vh-100"> 
	<header class="p-3 bg-dark text-white">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid col-lg-8">
				<a class="navbar-brand" href="../home"><img src="../img/icons/favicon/favicon-96x96.png" alt="" width="30" height="30" class="d-inline-block align-text-top me-2">FS-Quiz</a>
				<a class="navbar-brand" id="count"></a>
			</div>
		</nav>
	</header>
  
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
	<div id="divStart" style="display: block;">
		<h1><?php echo $eventName ?> Registration Quiz <?php echo $data->year; ?></h1>
		<div class="row g-5">
		<div class="col-md-6">
			<h3>Information</h3>
			<p id="maxInfo" style="margin-bottom: 0;">Questions: <?php echo count($data->questions); ?></p>
			<p id="timeInfo" style="margin-bottom: 0;">Time: x</p>
			<p id="classInfo" style="margin-bottom: 0;">Class: <?php echo $data->class; ?></p>
			<p id="statusInfo" style="margin-bottom: 0;">Status: <?php echo str_replace("_", " ", $data->status); ?></p>
			<p id="Infoinfo" style="margin-bottom: 0;">Date: <?php echo (is_null($data->date)) ? '-' : date_format(date_create($data->date), 'jS F Y') ; ?></p>
			<p id="Infoinfo" style="margin-bottom: 0;">Infomation: <?php echo (is_null($data->information)) ? '-' : str_replace("\\n", "<br>",$data->information); ?></p>
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
			<div style="display: none;" class="form-check form-switch" id="settingSubmitDiv">
				<input class="form-check-input" type="checkbox" id="settingSubmit" checked>
				<label class="form-check-label" for="settingSubmit">Multiple submission</label>
			</div>
		</div>
		</div>
		<div class="row g-5">
		<div class="col-md-6">
			<h3>Documents</h3>
			<ul id="doc" class="icon-list">
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
		<p id="resultCount"></p>
	</div>
	<div id="questionBody">
		
	</div>
	<div id="questionFooter" style="display: none;" class="container">
		<div class="row">
			<div class="col"></div>
			<div id="time" class="col text-center">
				<p class="fs-5" id="timeText"> </p>
			</div>
			<div id="button" class="col text-end">
				<input id="submitButton" class="btn btn-primary" onclick="submit()" type="submit" value="Submit">
			</div>
		</div>
	</div>
</div>
</div>
 
</div> 
</main>
</div> 
<script>
var jsondata = <?php echo json_encode($data); ?>;
</script>
<footer class="footer mt-auto bg-light">
  <div class="col-lg-8 mx-auto p-3 text-dark">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <a href="../contact" class="text-muted" style="text-decoration: none;">Contact</a>
    </div>
	<div class="col-md-auto">
      <a href="/statistics" class="text-muted" style="text-decoration: none;">Statistics</a>
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
</html>