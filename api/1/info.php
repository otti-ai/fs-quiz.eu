<?php
	require('orginal_db.php');
  require("class/event.php");
  require("class/question.php");
  require("class/document.php");
  require("class/answer.php");
  require("class/image.php");
  require("class/solution.php");
  require("class/quiz.php");
  require("class/db_orginal.php");
  require('class/doc_print.php');
  require('class/questionQuiz.php');
  require('statistic.php');
  $printer = new Doc_Print();
  $printer = $printer->createChapter();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="https://api.fs-quiz.eu">
    <!-- Bootstrap CSS -->
    <link href="https://fs-quiz.eu/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fs-quiz.eu/css/styleMenu.css" rel="stylesheet">
    <link href="https://fs-quiz.eu/css/styleCode.css" rel="stylesheet">
    <script src="https://fs-quiz.eu/js/bootstrap.min.js"></script>

    <title>API FS-Quiz</title>
  </head>
  <body style="overflow: hidden;">
    <!-- Navigation Top-->
	<header class="p-3 bg-dark text-white">
		<nav class="navbar navbar-dark bg-dark navbar-expand-md">
			<a href="/" class="d-flex align-items-center text-white text-decoration-none">
        <span class="fs-5 fw-semibold">API Dokumentation - FS-Quiz.eu</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
		</nav>
	</header>
  <!-- Navigation Site-->
    <main class="d-md-flex" style="background-color: rgba(0, 0, 0, .1);">
      <div class="d-md-flex collapse" id="navbarToggleExternalContent" style="flex: 0 0 auto;">
      <div class="p-3 bg-white" style="min-width: 15vw;">
        <div class="align-items-center mb-3 text-dark text-decoration-none border-bottom">
          <p >Version: <br><small class="text-muted">1.0.1</small>
          <br>Last Update: <br><small class="text-muted">7th Jan, 2023</small></p>
        </div>
        <ul class="list-unstyled ps-0">
          <li class="mb-1">
            <a href="#Getting" style="text-align: left;" class="btn btn-notoggle align-items-center rounded d-block" >
              Getting Started
            </a>
          </li>
		
		  <?php
foreach($printer as $chapter){
	echo '<li class="mb-1"><button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#'.$chapter->name.'-collapse" aria-expanded="false">'.$chapter->titel;
	echo '</button><div class="collapse" id="'.$chapter->name.'-collapse"><ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">';
	foreach($chapter->parts as $part){
		echo '<li><a href="#get-'.$part->name.'" class="link-dark rounded">'.$part->titel.'</a></li>';
	}
	echo '</ul></div></li>';
}
?>
          
        </ul>
      </div>
      </div>
  <div style="max-height: 92vh;overflow: auto;max-width: 100vw;" class="container d-md-flex ">
    <div style="margin-left: auto; margin-right: auto;" class="row justify-content-md-center">
    <div class="col-auto" id="inhalt">
		  <div>
        <h2 id="Getting">Getting Started</h2>
        <p>The fs-quiz.eu API provides programmatic access to reading European Formula Student Quiz data. Retrieve a quiz, individual questions or documents, 
        filter them, etc.</p>
        <p><strong>To use this API, you will need an API-Key!</strong> Please contact me at <em>api@fs-quiz.eu</em> to get your own API-Key. The API-Key is used to limit the number of accesses and is completely free of charge. This limitation is used to keep the server performance stable so please avoid unnecessary accesses. More than <strong>10 requests within one minute will result in a 10 minute timeout</strong>.</p>
        <p>Please keep the API-Key for yourself and do not publish it. Each team gets only one API-Key, if it gets lost you will get a new one, the old one will be deactivated!</p>
        <p>As the API-Keys are created manually, it takes a little time for the request to be processed. It should not take longer than 24 hours. So that I can process the request directly, please write a contactable email and the team name in the email.</p>
      </div>
      <div class="bg-dark text-white codeBox">
        <code>
API Endpoint
  https://api.fs-quiz.eu
        </code>
      </div>
      <hr>
      <div>
        <h2>Images</h2>
        <p>The API gives the path to each image. To call up an image, the path is appended to <em>img.fs-quiz.eu</em>. A fully functional image URL looks like this:</p>
      </div>
      <div class="bg-dark text-white codeBox">
        <code>
Image URL
  https://img.fs-quiz.eu/57_1.jpg
        </code>
      </div>
      <hr>
      <div>
        <h2>Documents</h2>
        <p>The current and former documents of the rules and events are stored in the database. In addition to the year and version, each document is also assigned to a type. These are:</p>
        <ul>
          <li>Rulebook: General rules of the season</li>
          <li>Hybrid Rules: Rules for hybrid vehicles which are supported by some events</li>
          <li>Additional Rules: Additional event specific rules that partly override the general rules</li>
          <li>Handbook: Event Handbooks</li>
          <li>Registration: Documents about the registration process</li>
          <li>Additional Documents: Documents that are useful but do not fit into any other category</li>
        </ul>
        <p>Similar to the images, the API gives the path to each document. To access a document, the path is appended to <em>doc.fs-quiz.eu</em>. A fully functional document URL looks like this:</p>
      </div>
      <div class="bg-dark text-white codeBox">
        <code>
Documents URL
  https://doc.fs-quiz.eu/FS-Rules_2023_v1.1.pdf
        </code>
      </div>
		<hr>
	<?php
foreach($printer as $chapter){
    echo '<div id="'.$chapter->name.'">';
    $parts = $chapter->parts;
    foreach($parts as $part){
        echo '<div id="get-'.$part->name.'">';
        echo '<span class="text-muted">'.$part->titel.'</span>';
        echo '<h2> <span class="text-success text-uppercase fw-bolder">'.$part->type.': </span><span>'.$part->link.'</span></h2></div>';
        echo '<div class="p-3"><h3>Parameters</h3><div class="p-3 table-responsive"><table class="table table-bordered bg-white"><tbody>';
        foreach($part->param as $param){
            echo '<tr><td class="w-40 spc col"><div style="inline-size: max-content;">'.$param->name.'</div></td>';
            echo '<td class="w-5"><div style="inline-size: max-content;">'.$param->type.'</div></td>';
            echo '<td class="w-50"><div style="inline-size: max-content;">'.$param->doc_text.'</div></td>';
            if($param->required){
                echo '<td class="w-5 fw-bolder">required</td></tr>';
            }else{
                echo '<td class="w-5">optional</td></tr>';
            }
        }
        echo '</tbody></table></div><h3>Response</h3><div class="p-3 table-responsive"><table class="table table-bordered bg-white"><tbody>';
        $name_coll = '';
        foreach($part->response as $response){
            if($response->array){
              if($response->array2){
                if($response->head){
                  echo '<tr class="collapse bg-collapse" id="'.$name_coll.'">';
                  echo '<td class="w-40 spcc"><div style="inline-size: max-content;"><svg viewBox="0 0 16 16" width="10" height="10"><path stroke="rgba(0,0,0,.5)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" d="M5 14l6-6-6-6"></path></svg>'.$response->name.'</div></td>';
                }else{
                  echo '<tr class="collapse bg-collapse" id="'.$name_coll.'">';
                  echo '<td class="w-40 spxx"><div style="inline-size: max-content;">'.$response->name.'</div></td>';
                }
              }else{
                if($response->head){
                    $name_coll = 'collapse_'.$chapter->name.'_'.$response->name.'_'.$response->array_id;
                    echo '<tr class="table-open collapsed" data-bs-toggle="collapse" data-bs-target="#'.$name_coll.'" aria-expanded="false" aria-controls="'.$name_coll.'">';
                    echo '<td class="w-40"><div style="inline-size: max-content;"><svg viewBox="0 0 16 16" width="10" height="10"><path stroke="rgba(0,0,0,.5)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" d="M5 14l6-6-6-6"></path></svg>'.$response->name.'</div></td>';
                }else{
                    echo '<tr class="collapse bg-collapse" id="'.$name_coll.'">';
                    echo '<td class="w-40 spx"><div style="inline-size: max-content;">'.$response->name.'</div></td>';
                }
              }
              echo '<td class="w-5"><div style="inline-size: max-content;">'.$response->type.'</div></td>';
              echo '<td class="w-50"><div style="inline-size: max-content;">'.$response->doc_text.'</div></td>';
              if($response->required){
                  echo '<td class="w-5 fw-bolder">required</td></tr>';
              }else{
                  echo '<td class="w-5">optional</td></tr>';
              }
            }else{
                echo '<tr><td class="w-40 spc">'.$response->name.'</td>';
                echo '<td class="w-5"><div style="inline-size: max-content;">'.$response->type.'</div></td>';
                echo '<td class="w-50"><div style="inline-size: max-content;">'.$response->doc_text.'</div></td>';
                if($response->required){
                    echo '<td class="w-5 fw-bolder">required</td></tr>';
                }else{
                    echo '<td class="w-5">optional</td></tr>';
                }
            }
        }
        echo '</tr></tbody></table></div><h3>Example</h3><div class="p-3"><div class="bg-dark text-white codeBox"><code>';
        $text = file("1/txt/".$part->name.".txt");
        for($i=0;$i < count($text); $i++){
            echo $text[$i];
        }
        echo '<br></code></div></div></div><hr>';
    }
    echo '</div>';
}	
	
	?>
    </div>
    </div>
  </div>
</main>
  </body>
</html>