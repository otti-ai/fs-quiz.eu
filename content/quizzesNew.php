<?php 
	require('header.php');
class EventHandle{
	$eventName;
	$quizzesEV = array();
	$quizzesCV = array();
	$quizzesDV = array();
}

$jsonEvent = json_decode(file_get_contents('http://api.fs-quiz.eu/1/'.$api.'/event'));
$events = $jsonEvent->events;
$eventObjects = array();
foreach($events as $event){
	$eventObject = new EventHandle;
	$jsonQuizzes = json_decode(file_get_contents('http://api.fs-quiz.eu/1/'.$api.'/event/'. $event->id .'/quizzes'));
	foreach($jsonQuizzes->quizzes as $q){
		if($q->status != 'unpublished'){
			if($q->class == 'ev'){
				array_push($eventObject->quizzesEV, $q);
			}else if($q->class == 'cv'){
				array_push($eventObject->quizzesCV, $q);
			}else if($q->class == 'dv'){
				array_push($eventObject->quizzesDV, $q);
			}
		}
	}
	array_push($eventObjects, $eventObject);
}
usort($eventObjects, function($a, $b) {
	return count($a->quizzesEV) > count($b->quizzesEV) ? -1 : 1;
});
?>
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Registration quizzes</h1>
    <p class="fs-5">This list is constantly updated.
	More quizzes coming soon.</p>
    <hr class="col-3 col-md-2">

	<p>* not all correct answer available<br>** incomplete</p>
	<hr class="col-3 col-md-2 mb-5">

	<table class="table table-striped mb-0">
		<thead>
			<tr>
				<?php
				$countingtable1 = 0;
			
				foreach($events as $event){
					$eventName = str_replace('Formula Student', 'FS', $event->event_name);
					echo '<th class="col-3" scope="col">'.$eventName.'</th>';
				}
				?>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="col-3">Mark</td>
				<td class="col-3">Otto</td>
				<td class="col-3">@mdo</td>
			</tr>
			<tr>
				<td class="col-3">Mark</td>
				<td class="col-3">Otto</td>
				<td class="col-3">@mdo</td>
			</tr>
		</tbody>
	</table>
	<div class="collapse" id="collapseExample">
	<table class="table table-striped mt-0">
		<tbody>
			<tr>
				<td class="col-3">Jacob</td>
				<td class="col-3">Thornton</td>
				<td class="col-3">@fat</td>
			</tr>
			<tr>
				<td class="col-3">Larry</td>
				<td class="col-3">the Bird</td>
				<td class="col-3">@twitter</td>
			</tr>
		</tbody>
	</table>
	</div>

	<p>
  		<a class="" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    		Show more
  		</a>
	</p>
	<h4>Changelog:</h4>
	<p id="changelog"></p>
	<p><a href="/changelog">More</a></p>
  </main>
<script>
getChangelog();
function getChangelog(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
			var r = "";
			var r = xmlHttp.responseText;
			document.getElementById("changelog").innerHTML = r;
		}
	}
	xmlHttp.open( "GET", "/php/getChangelog.php?type=1", true );
	xmlHttp.send( null );
}

</script>
  </div> 
<?php 
	require('footer.php');
?>