<?php 
	require('./header2.php');

  $jsonEvent = json_decode(file_get_contents('http://api.fs-quiz.eu/1/'.$api.'/event'));
	$events = $jsonEvent->events;
  $jsondoc = json_decode(file_get_contents('https://api.fs-quiz.eu/1/'.$api.'/document?year=2023'));
	$docs = $jsondoc->documents;
  usort($docs, function($a, $b) {
    return $a->event_id < $b->event_id ? -1 : 1;
  });
?>
<div class="col-lg-8 mx-auto p-3">
  <main>
    <h1>Training for the registration quizzes</h1>
    <p class="fs-5">This page is for training for the European Formula Student Registration quizzes. Old quizzes can be worked through here in the original or an individual adapted mode.</p>

    <div class="mb-2">
      <a href="/quizzes" class="btn btn-primary btn-lg px-4">Old quizzes</a>
    </div>

    <hr class="col-3 col-md-2">
	<h2>Dates</h2>
	<?php require('./php/eventgraph2.php'); ?>
	<hr class="col-3 col-md-2">
	
    <div class="row g-5">
      <div class="col-md-6">
        <h2>Registration</h2>
        <p>Information about the registration procedure</p>
        <ul class="icon-list">
          <?php
            foreach($docs as $doc){
              if($doc->type == "Registration"){
                echo '<li><a target="_blank" href="https://doc.fs-quiz.eu/'.$doc->path.'">';
                if($doc->event_id>0){
                  foreach($events as $event){
                    if($event->id == $doc->event_id){
                      echo str_replace('Formula Student', 'FS', $event->event_name);
                    }
                  }
                }else{
                  echo 'FS';
                }
                echo ' '.$doc->type.' '.$doc->year.' (v'.$doc->version.')'.'</a></li>';
              }
            }
          ?>
          <li><a target="_blank" href="https://www.formula-ata.it/how-to-register">SAE Italy</a></li>
        </ul>
      </div>

      <div class="col-md-6">
        <h2>Documents</h2>
        <p>Important documents for the registration quizzes</p>
        <ul class="icon-list">
          <?php
            foreach($docs as $doc){
              if($doc->type == "Registration"){
                break;
              }
              echo '<li><a target="_blank" href="https://doc.fs-quiz.eu/'.$doc->path.'">';
              if($doc->event_id>0){
                foreach($events as $event){
                  if($event->id == $doc->event_id){
                    echo str_replace('Formula Student', 'FS', $event->event_name);
                  }
                }
              }else{
                echo 'FS';
              }
              echo ' '.$doc->type.' '.$doc->year.' (v'.$doc->version.')'.'</a></li>';
            }
          ?>
        </ul>
      </div>
    </div>
    <hr class="col-3 col-md-2 mb-5">
    <h2>API for quiz database</h2>
    <p class="fs-5">Below you will find the access and documentation of the available methods for the Quiz, Event, Solution and Image API.</p>
    <p class="text-muted" style="font-size:1rem;"><strong>Please note</strong> that the API documentation is not optimised for mobile devices. You should access these pages on a desktop computer and browser.</p>

    <div class="mb-2">
      <a href="http://api.fs-quiz.eu" class="btn btn-primary btn-lg px-4">View API</a>
    </div>
    <hr class="col-3 col-md-2 mb-5">
    <h3>Changelog</h3>
    <p id="changelog"></p>
	  <p><a href="/changelog">More</a></p>
  </main>
  </div> 
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
	xmlHttp.open( "GET", "/php/getChangelog.php?type=0", true );
	xmlHttp.send( null );
}

</script>
  <?php 
	require('./footer.php');
?>