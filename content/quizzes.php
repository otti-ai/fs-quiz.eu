<?php 
	require('header.php'); 
	?>
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Registration quizzes</h1>
    <p class="fs-5">This list is constantly updated.
	More quizzes coming soon.</p>
    <hr class="col-3 col-md-2">

<?php
	$jsonEvent = json_decode(file_get_contents('http://api.fs-quiz.eu/1/'.$api.'/event'));
	$events = $jsonEvent->events;
	$htmlArrayEV = array();
	$htmlArrayCV = array();
	$htmlArrayDV = array();
	foreach($events as $event){
		$jsonQuizzes = json_decode(file_get_contents('http://api.fs-quiz.eu/1/'.$api.'/event/'. $event->id .'/quizzes'));
		$quizzesEV = array();
		$quizzesCV = array();
		$quizzesDV = array();
		foreach($jsonQuizzes->quizzes as $q){
			if($q->status != 'unpublished'){
				if($q->class == 'ev'){
					array_push($quizzesEV, $q);
				}else if($q->class == 'cv'){
					array_push($quizzesCV, $q);
				}else if($q->class == 'dv'){
					array_push($quizzesDV, $q);
				}
			}
		}
		if(count($quizzesEV)>0){
			$eventName = str_replace('Formula Student', 'FS', $event->event_name);
			$htmlText = '<p class="fs-5">'.$eventName.':</p>';
			usort($quizzesEV, function($a, $b) {
				return $a->year > $b->year ? -1 : 1;
			});
			$htmlText .= '<ul class="icon-list">';
			foreach($quizzesEV as $quiz){
				$htmlText .= '<li><a href="/quiz/'.$quiz->quiz_id.'">'.$quiz->year;
				if(str_contains($quiz->information,'Retake')){$htmlText .= ' V2';}
				if(str_contains($quiz->information,'Testquiz')){$htmlText .= ' Test';}
				$htmlText .= "</a>";
				if($quiz->status == "missing_correct_answer"){$htmlText .= "*";}
				if($quiz->status == "incomplete"){$htmlText .= "**";}
				$htmlText .= '</li>';
			}
			$htmlText .= '</ul>';
			array_push($htmlArrayEV,$htmlText);
		}
		if(count($quizzesCV)>0){
			$eventName = str_replace('Formula Student', 'FS', $event->event_name);
			$htmlText = '<p class="fs-5">'.$eventName.':</p>';
			usort($quizzesCV, function($a, $b) {
				return $a->year > $b->year ? -1 : 1;
			});
			$htmlText .= '<ul class="icon-list">';
			foreach($quizzesCV as $quiz){
				$htmlText .= '<li><a href="/quiz/'.$quiz->quiz_id.'">'.$quiz->year.'</a>';
				if($quiz->status == "missing_correct_answer"){$htmlText .= "*";}
				if($quiz->status == "incomplete"){$htmlText .= "**";}
				$htmlText .= '</li>';
			}
			$htmlText .= '</ul>';
			array_push($htmlArrayCV,$htmlText);
		}
		if(count($quizzesDV)>0){
			$eventName = str_replace('Formula Student', 'FS', $event->event_name);
			$htmlText = '<p class="fs-5">'.$eventName.':</p>';
			usort($quizzesDV, function($a, $b) {
				return $a->year > $b->year ? -1 : 1;
			});
			$htmlText .= '<ul class="icon-list">';
			foreach($quizzesDV as $quiz){
				$htmlText .= '<li><a href="/quiz/'.$quiz->quiz_id.'">'.$quiz->year.'</a>';
				if($quiz->status == "missing_correct_answer"){$htmlText .= "*";}
				if($quiz->status == "incomplete"){$htmlText .= "**";}
				$htmlText .= '</li>';
			}
			$htmlText .= '</ul>';
			array_push($htmlArrayDV,$htmlText);
		}
	}
	usort($htmlArrayEV, function($a, $b) {
		return strlen($a) > strlen($b) ? -1 : 1;
	});
	usort($htmlArrayCV, function($a, $b) {
		return strlen($a) > strlen($b) ? -1 : 1;
	});
	echo '<h3>EV Class:</h3><div class="container-fluid"><div class="row row-cols-auto">';
	foreach($htmlArrayEV as $text){
		echo '<div class="col">'. $text .'</div>';
	}
	echo '</div></div><hr class="col-3 col-md-2"><h3>CV Class:</h3><div class="container-fluid"><div class="row row-cols-auto">';
	foreach($htmlArrayCV as $text){
		echo '<div class="col">'. $text .'</div>';
	}
	echo '</div></div><hr class="col-3 col-md-2"><h3>DV Class:</h3><div class="container-fluid"><div class="row row-cols-auto">';
	foreach($htmlArrayDV as $text){
		echo '<div class="col">'. $text .'</div></div></div>';
	}
?>

	<p>* not all correct answer available<br>** incomplete</p>
	<hr class="col-3 col-md-2 mb-5">
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