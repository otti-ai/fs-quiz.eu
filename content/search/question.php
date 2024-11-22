<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/header.php');
	$jsonEvents = file_get_contents('https://api.fs-quiz.eu/2/event');
	$eventList = json_decode($jsonEvents);
	$name = "";
	$event = isset($event) ? $event : '';
	$year = isset($year) ? $year : '';
	$type = isset($type) ? $type : '';
?>
<script src="/js/search.js?v1.2" type="text/javascript"></script>
<link href="/css/all.css" rel="stylesheet">
<div class="container-fluid col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Search for Question</h1>
    <div class="container container-fluid">
		<div id="filter" class="row row-cols-auto">
			<div class="col mb-2">
				<div class="form-floating">
					<input oninput="searchQuestions2()" id="textSearch" type="text" class="form-control" id="floatingInput" >
  					<label for="floatingInput">Text</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="searchQuestions2()" class="form-select" id="eventSelect" aria-label="eventSelect">
						<option <?php if ($event == "") {echo 'selected';} ?> value="0">Any</option>
						<?php
						foreach($eventList->events as $e){
							echo '<option ';
							if($event == $e->id){echo 'selected';}
							echo ' value="'.$e->id.'">'.str_replace('Formula', '', str_replace('Formula Student', 'FS', $e->event_name)).'</option>';
						}
						?>
					</select>
					<label for="eventSelect">Event</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="searchQuestions2()" class="form-select" id="yearSelect" aria-label="yearSelect">
						<option <?php if ($year == "") {echo 'selected';} ?> value="0">Any</option>
						<?php
						for($i = date("Y");$i >= 2011;$i--){
							echo '<option ';
							if ($year == $i) {echo 'selected';}
							echo ' value="'.$i.'">'.$i.'</option>';
						}
						?>
					</select>
					<label for="yearSelect">Year</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="searchQuestions2()" class="form-select" id="classSelect" aria-label="classSelect">
						<option value="q" selected>Any</option>
						<option value="ev">EV</option>
						<option value="cv">CV</option>
						<option value="dv">DV</option>
					</select> 
					<label for="classSelect">Class</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="searchQuestions2()" class="form-select" id="typSelect" aria-label="typSelect">
						<option selected>Any</option>
						<option value="math">Math</option>
						<option value="rule">Rule</option>
						<option value="scoring">Scoring</option>
					</select>
					<label for="typSelect">Type</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="searchQuestions2()" class="form-select" id="categorySelect" aria-label="categorySelect">
						<option selected>Any</option>
						<option value="electronic">Electronic</option>
						<option value="mechanical">Mechanical</option>
					</select>
					<label for="categorySelect">Category</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="searchQuestions2()" class="form-select" id="disSelect" aria-label="disSelect">
						<option selected>Any</option>
						<option value="dynamic">Dynamic</option>
						<option value="static">Static</option>
					</select>
					<label for="disSelect">Disciplines</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="searchQuestions2()" class="form-select" id="answerSelect" aria-label="answerSelect">
						<option selected>Any</option>
						<option value="single">Single Choice</option>
						<option value="multi">Multiple Choice</option>
						<option value="input">Value Input</option>
					</select>
					<label for="answerSelect">Answer type</label>
				</div>
			</div>
			<div class="col">
				<div class="form-check">
  					<input onchange="searchQuestions2()" class="form-check-input" type="checkbox" value="" id="imgSelect">
  					<label class="form-check-label" for="imgSelect">only with image</label>
				</div>
				<div class="form-check">
  					<input onchange="searchQuestions2()" class="form-check-input" type="checkbox" value="" id="solutionSelect">
  					<label class="form-check-label" for="solutionSelect">explanation available</label>
				</div>
			</div>
		</div>
		<hr class="col-3 col-md-2">
		<div class="row table-responsive">
			<table class="table table-striped table-bordered caption-top align-middle">
			<caption id="count"></caption>
				<thead>
					<tr>  
						<th style="cursor: pointer;" onclick="SortTable(this,0, true)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>ID</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,1, true)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Year</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,2, false)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Class</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,3, false)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Text</span>
						</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody id="doc">
					<tr><td class='text-center' colspan='5'>
						<div class="spinner-border" role="status">
							<span class="visually-hidden">Loading...</span>
						</div></td></tr>
				</tbody>
			</table>
		</div>
	</div>
  </main>

  </div> 
<script>
document.addEventListener('DOMContentLoaded', function() {
	loadQuestions();
}, false);
</script>
<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/footer.php');
?>